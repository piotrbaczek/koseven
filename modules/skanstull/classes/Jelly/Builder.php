<?php

/**
 * Description of Builder
 *
 * @author nzpetter
 */
class Jelly_Builder extends Jelly_Core_Builder
{
    /**
     * Checks if model is internally NOT DELETED
     * @return $this
     * @throws Kohana_Exception
     */
    public function active()
    {
        $fields = $this->meta()->fields();

        if (in_array('is_deleted', array_keys($fields)))
        {
            $this->where('is_deleted', '=', FALSE);
            return $this;
        }
        else
        {
            throw new Kohana_Exception(':model doesn\'t have an is_deleted field', array(':model' => $this->meta()->model()));
        }
    }

    /**
     * Checks if model is INTERNALLY DELETED
     * @return $this
     * @throws Kohana_Exception
     */
    public function inactive()
    {
        $fields = $this->meta()->fields();

        if (in_array('is_deleted', array_keys($fields)))
        {
            $this->where('is_deleted', '=', TRUE);
            return $this;
        }
        else
        {
            throw new Kohana_Exception(':model doesn\'t have an is_deleted field', array(':model' => $this->meta()->model()));
        }
    }

}
