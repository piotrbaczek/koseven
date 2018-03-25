<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author nzpetter
 */
class Jelly_Model extends Jelly_Core_Model
{
    public function getRelationships(): array
    {
        $relationships = [];
        foreach ($this->meta()->fields() as $field)
        {
            if ($field instanceof Jelly_Field_BelongsTo || $field instanceof Jelly_Field_HasMany || $field instanceof Jelly_Field_Manytomany)
            {
                if ($field->private)
                {
                    continue;
                }
                else
                {
                    $relationships[] = $field->name;
                }
            }
        }

        return $relationships;
    }

}
