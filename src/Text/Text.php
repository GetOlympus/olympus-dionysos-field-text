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
     * @var string
     */
    protected $style = 'css'.S.'text.css';

    /**
     * @var string
     */
    protected $template = 'text.html.twig';

    /**
     * @var string
     */
    protected $textdomain = 'textfield';

    /**
     * Prepare defaults.
     *
     * @return array
     */
    protected function getDefaults()
    {
        return [
            'title' => Translate::t('text.title', $this->textdomain),
            'default' => '',
            'description' => '',
            'maxlength' => '',
            'placeholder' => '',
            'settings' => [
                'type' => 'text',
                'min' => '',
                'max' => '',
                'step' => '',
                'display' => false,
                'class' => '',
                'before' => '',
                'after' => '',
            ],
        ];
    }

    /**
     * Prepare variables.
     *
     * @param  object  $value
     * @param  array   $contents
     *
     * @return array
     */
    protected function getVars($value, $contents)
    {
        // Available input types
        $types = [
            'date', 'datetime-local', 'datetime', 'email',
            'hidden', 'month', 'number', 'password', 'range',
            'search', 'tel', 'text', 'time', 'week'
        ];

        // Get contents
        $vars = $contents;

        // Class
        $vars['class'] = isset($contents['settings']['class']) ? $contents['settings']['class'] : '';

        // Prepend & Append
        $vars['before'] = isset($contents['settings']['before']) ? $contents['settings']['before'] : '';
        $vars['after'] = isset($contents['settings']['after']) ? $contents['settings']['after'] : '';

        // Type -- Special case on "datetime-local" which can be "datetime" as alias
        $vars['type'] = isset($contents['settings']['type']) ? $contents['settings']['type'] : 'text';
        $vars['type'] = in_array($vars['type'], $types) ? $vars['type'] : 'text';
        $vars['type'] = 'datetime' === $vars['type'] ? 'datetime-local' : $vars['type'];

        // Attributes
        $vars['attrs'] = 'size="30"';
        $vars['attrs'] .= !empty($contents['placeholder']) ? ' placeholder="'.$contents['placeholder'].'"' : '';
        $vars['attrs'] .= !empty($contents['maxlength']) ? ' maxlength="'.$contents['maxlength'].'"' : '';

        // Hidden case
        if ('hidden' === $vars['type']) {
            // Get description
            $vars['description'] = isset($contents['settings']['display']) && $contents['settings']['display']
                ? sprintf(Translate::t('text.hidden.description.show', $this->textdomain), $value)
                : Translate::t('text.hidden.description.hide', $this->textdomain);
        }

        // Number and Range case
        if ('number' === $vars['type'] || 'range' === $vars['type']) {
            $contents['settings']['step'] = isset($contents['settings']['step']) ? $contents['settings']['step'] : 1;

            $vars['attrs'] .= isset($contents['settings']['min']) ? ' min="'.$contents['settings']['min'].'"' : '';
            $vars['attrs'] .= isset($contents['settings']['max']) ? ' max="'.$contents['settings']['max'].'"' : '';
            $vars['attrs'] .= ' step="'.$contents['settings']['step'].'"';

            $vars['before'] = isset($contents['settings']['min']) ? $contents['settings']['min'] : $vars['before'];
            $vars['after'] = isset($contents['settings']['max']) ? $contents['settings']['max'] : $vars['after'];
        }

        // Update vars
        return $vars;
    }
}
