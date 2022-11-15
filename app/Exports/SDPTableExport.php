<?php

namespace App\Exports;

use App\Models\Debate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SDPTableExport implements FromCollection, WithMapping, WithHeadings {

    public function headings () : array {

        $headings = [
            'Podcast Number',
            'Debate Name',
            'Apandah Won',
            'Aztrosist Won',
            'Jschlatt Won',
            'Mikasacus Won',
        ];

        if (Debate::whereNotNull('guest')->count() > 0) {
            $headings = array_merge($headings, ['Guest']);
        }

        return array_merge($headings,  [
            'Winning Side',
            'Podcast Link',
            'Podcast Upload Date'
        ]);
    }

    public function map ($Debate) : array {

        $columns = [
            $Debate->podcast_number,
            $Debate->debate_name,
            $Debate->apandah ? 'Won' : 'Lose',
            $Debate->aztro ? 'Won' : 'Lose',
            $Debate->schlatt ? 'Won' : 'Lose',
            $Debate->mika ? 'Won' : 'Lose',
        ];

        if (Debate::where('was_there_a_guest', true)->count() > 0 ) {
            if ($Debate->guest != null && $Debate->guest_name != null ) {
                if ($Debate->guest) {
                    $columns = array_merge($columns, [$Debate->guest_name . ' Won']);
                } else {
                    $columns = array_merge($columns, [$Debate->guest_name . ' Lose']);
                }
            } else {
                $columns = array_merge($columns, ['']);
            }
        } 

        return array_merge($columns, [
            $Debate->winning_side,
            $Debate->podcast_link,
            $Debate->getFormattedPodcastUploadDate()
        ]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        return Debate::orderBy('podcast_upload_date', 'DESC')->get();
    }
}
