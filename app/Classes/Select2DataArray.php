<?php


namespace App\Classes;


class Select2DataArray
{
    public static function getStructured($items, $more)
    {
        foreach ($items as $k =>$v){
            $items[$k]->text =$items[$k]->full_address;
        }

        return [
            'results' => $items,
            'pagination' => ['more' => $more]
        ];
    }
}


//    {
//        "results": [
//        {
//            "id": 1,
//          "text": "Option 1"
//        },
//        {
//            "id": 2,
//          "text": "Option 2"
//        }
//      ],
//      "pagination": {
//        "more": true
//      }
//    }
