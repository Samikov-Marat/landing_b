<?php

namespace App\Classes;
use App\TextType;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TextTypesCleaner
{

    public function clear(){
        $files = Storage::disk('views')->allFiles('site');

        $usedTextTypes = collect();

        foreach ($files as $file){
            $contents = Storage::disk('views')->get($file);
            preg_match_all('#\\$dictionary\\[\'(.*?)\'\\]#u', $contents, $m);
            foreach ($m[1] as $shortname){
                $usedTextTypes->push($shortname);
            }
            preg_match_all('#@d\\(\'(.*?)\'\\)#u', $contents, $m);
            foreach ($m[1] as $shortname){
                $usedTextTypes->push($shortname);
            }
        }

        $textTypes = TextType::select('id', 'shortname')->get();
        foreach ($textTypes as $textType){
            if(Str::startsWith($textType->shortname, '_')){
                dump('>>> ' . $textType->shortname);
                continue;
            }

            if(!$usedTextTypes->contains($textType->shortname)){
                dump($textType->shortname);
            }
        }

    }


}
