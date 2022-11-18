<?php


namespace App\Classes;


class MapJsonCallback
{
    var $streamName = '';
    var $stream = null;
    var $callbackName = '';

    var $delim = '';

    public function __construct($streamName = 'php://output')
    {
        $this->streamName = $streamName;
    }

    public function setCallbackName($callbackName)
    {
        $this->callbackName = preg_replace('#[^\w]+#u', '_', $callbackName);
    }

    public function start()
    {
        $this->stream = fopen($this->streamName, 'w');
        fwrite($this->stream, $this->callbackName . '(');
        fwrite($this->stream, '{"type":"FeatureCollection","features":[');
    }

    public function add($office)
    {
        $feature = [
            'type' => 'Feature',
            'id' => $office->code,
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [(float)$office->coordinates->y, (float)$office->coordinates->x],
            ],
            'properties' => [
                    'balloonContent' => $office->address . '<br>' .
                        $office->addressComment . '<br>' .
                        $office->email   . '<br>' .
                        $office->phone,
//                'balloonContent' => $office->address,
                'clusterCaption' => 'CDEK',
                'hintContent' => $office->address
            ]

        ];
        fwrite($this->stream, $this->delim . json_encode($feature));
        $this->delim = ',';
    }

    public function finish()
    {
        fwrite($this->stream, ']}');
        fwrite($this->stream, ')');
        fclose($this->stream);
    }


}
