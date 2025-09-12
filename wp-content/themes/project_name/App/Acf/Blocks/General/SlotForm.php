<?php

namespace App\Acf\Blocks\General;

use App\Acf\Blocks\Helpers\Block;
use App\Acf\Blocks\RegisterBlock;

final class SlotForm implements \App\Acf\Blocks\Helpers\BlockItem
{

    public static function setBlockParams(): void
    {
        RegisterBlock::addBlock(new Block('SlotForm',
                'Slot Form',
                'Slot Form block',
                'templates/parts/slot-form.php',
                '',
                '',
                array(
                    'align' => false,
                    'mode' => true,
                    'jsx' => true
                ),
                array(
                    'title' => "Slot Form block",
                    'description' => "Slot Form block"
                ),
                'image',
                'custom'
            )
        );
    }
}