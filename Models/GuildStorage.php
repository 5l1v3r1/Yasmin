<?php
/**
 * Yasmin
 * Copyright 2017 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin\Models;

class GuildStorage extends Collection
    implements \CharlotteDunois\Yasmin\Interfaces\StorageInterface { //TODO: Docs
    
    protected $client;
    
    function __construct(\CharlotteDunois\Yasmin\Client $client, array $data = null) {
        parent::__construct($data);
        $this->client = $client;
    }
    
    function __get($name) {
        switch($name) {
            case 'client':
                return $this->client;
            break;
        }
        
        return null;
    }
    
    function resolve($guild) {
        if($guild instanceof \CharlotteDunois\Yasmin\Models\Guild) {
            return $guild;
        }
        
        if(\is_string($guild) && $this->has($guild)) {
            return $this->get($guild);
        }
        
        throw new \InvalidArgumentException('Unable to resolve unknown guild');
    }
}