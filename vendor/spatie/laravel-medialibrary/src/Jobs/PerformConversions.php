<?php

namespace Spatie\MediaLibrary\Jobs;

use Spatie\MediaLibrary\Media;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\MediaLibrary\FileManipulator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\MediaLibrary\Conversion\ConversionCollection;

class PerformConversions extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var \Spatie\MediaLibrary\Conversion\ConversionCollection
     */
    protected $conversions;

    /**
     * @var \Spatie\MediaLibrary\Media
     */
    protected $media;

    public function __construct(ConversionCollection $conversions, Media $media)
    {
        $this->conversions = $conversions;
        $this->media = $media;
    }

    public function handle() : bool
    {
        app(FileManipulator::class)->performConversions($this->conversions, $this->media);

        return true;
    }
}
