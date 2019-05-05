<?php

namespace GetOlympus\Field;

use GetOlympus\Zeus\Field\Controller\Field;
use GetOlympus\Zeus\Translate\Controller\Translate;

/**
 * Builds Text field.
 *
 * @package Field
 * @subpackage Text
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 * @see https://olympus.readme.io/v1.0/docs/text-field
 *
 */

class Text extends Field
{
    /**
     * Prepare variables.
     */
    protected function setVars()
    {
        $this->getModel()->setFaIcon('fa-text-width');
        $this->getModel()->setStyle('css'.S.'text.css');
        $this->getModel()->setTemplate('text.html.twig');
    }

    /**
     * Prepare HTML component.
     *
     * @param array $content
     * @param array $details
     */
    protected function getVars($content, $details = [])
    {
        // Build defaults
        $defaults = [
            'id' => '',
            'title' => Translate::t('text.title', [], 'textfield'),
            'default' => '',
            'description' => '',
            'options' => [
                'type' => 'text',
                'min' => '',
                'max' => '',
                'step' => '',
                'class' => '',
                'before' => '',
                'after' => '',
            ],

            // options
            'attrs' => '',
            'placeholder' => '',
            'maxlength' => '',
        ];

        // Build defaults data
        $vars = array_merge($defaults, $content);

        // Retrieve field value
        $vars['val'] = $this->getValue($content['id'], $details, $vars['default']);

        // Attributes
        $vars['attrs'] = 'size="30"';
        $vars['attrs'] .= !empty($vars['placeholder']) ? ' placeholder="'.$vars['placeholder'].'"' : '';
        $vars['attrs'] .= !empty($vars['maxlength']) ? ' maxlength="'.$vars['maxlength'].'"' : '';

        // Class
        $vars['class'] = isset($vars['options']['class']) && !empty($vars['options']['class']) ? $vars['options']['class'] : '';

        // Prepend & Append
        $vars['before'] = isset($vars['options']['before']) && !empty($vars['options']['before']) ? $vars['options']['before'] : '';
        $vars['after'] = isset($vars['options']['after']) && !empty($vars['options']['after']) ? $vars['options']['after'] : '';

        // Check type
        $type = isset($vars['options']['type']) && !empty($vars['options']['type']) ? $vars['options']['type'] : 'text';
        $vars['type'] = $type;

        // Check options
        if ('number' === $type || 'range' === $type) {
            // Special variables
            $vars['attrs'] .= isset($vars['options']['min']) && !empty($vars['options']['min']) ? ' min="'.$vars['options']['min'].'"' : '';
            $vars['attrs'] .= isset($vars['options']['max']) && !empty($vars['options']['max']) ? ' max="'.$vars['options']['max'].'"' : '';
            $vars['attrs'] .= isset($vars['options']['step']) && !empty($vars['options']['step']) ? ' step="'.$vars['options']['step'].'"' : ' step="1"';
        }

        // Update vars
        $this->getModel()->setVars($vars);
    }
}
