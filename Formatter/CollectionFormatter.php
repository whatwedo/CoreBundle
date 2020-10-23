<?php
/*
 * Copyright (c) 2016, whatwedo GmbH
 * All rights reserved
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace whatwedo\CoreBundle\Formatter;

use Doctrine\Common\Collections\Collection;

/**
 * Class CollectionFormatter.
 */
class CollectionFormatter extends AbstractFormatter
{
    /**
     * returns a string which represents the value.
     *
     * @param $value
     *
     * @return string
     */
    public function getString($value)
    {
        if (\is_array($value)
            || $value instanceof \Iterator) {
            return '';
        }
        if ($value instanceof Collection) {
            $value = $value->toArray();
        }

        return implode(',', $value);
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getHtml($value)
    {
        if (\is_array($value)
            || $value instanceof \Iterator
            || $value instanceof Collection) {
            $str = '<ul>';
            foreach ($value as $entity) {
                $str .= '<li>'.$entity.'</li>';
            }
            $str .= '</ul>';

            return $str;
        }

        return '-';
    }
}
