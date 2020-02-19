<?php

namespace GetOlympus\Field;

use GetOlympus\Zeus\Field\Field;
use GetOlympus\Zeus\Utils\Translate;

/**
 * Builds Text field.
 *
 * @package DionysosField
 * @subpackage Text
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
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
    protected function getDefaults() : array
    {
        return [
            'title' => Translate::t('text.title', $this->textdomain),
            'default' => '',
            'description' => '',
            'placeholder' => '',
            'type' => 'text',
            'settings' => [],
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
    protected function getVars($value, $contents) : array
    {
        // Available input types
        $types = [
            'date', 'datetime-local', 'email', 'hidden', 'month', 'number',
            'password', 'range', 'search', 'tel', 'text', 'time', 'week'
        ];

        // Get contents
        $vars = $contents;

        // Type
        $vars['type'] = in_array($vars['type'], $types) ? $vars['type'] : 'text';

        // Settings
        $vars['settings'] = $this->getSettingsFromType($vars['type'], $vars['settings']);

        // Hidden case
        if ('hidden' === $vars['type']) {
            // Set custom description
            $description = $vars['settings']['display']
                ? sprintf(Translate::t('text.hidden.description.show', $this->textdomain), $value)
                : Translate::t('text.hidden.description.hide', $this->textdomain);

            // Get full description
            $vars['description'] = '<em>'.$description.'</em><br/>'.$vars['description'];
        }

        // Before and After
        $vars['before'] = $vars['settings']['before'];
        $vars['after'] = $vars['settings']['after'];

        // CSS Class
        $vars['class'] = ' '.$vars['settings']['class'];

        // Attributes
        $vars['attrs'] = '';
        $vars['attrs'] .= $vars['settings']['readonly'] ? ' readonly' : '';

        if (in_array($vars['type'], ['date', 'datetime-local', 'month', 'number', 'range', 'time', 'week'])) {
            $vars['attrs'] .= !empty($vars['settings']['max']) ? ' max="'.$vars['settings']['max'].'"' : '';
            $vars['attrs'] .= !empty($vars['settings']['min']) ? ' min="'.$vars['settings']['min'].'"' : '';
            $vars['attrs'] .= !empty($vars['settings']['step']) ? ' step="'.$vars['settings']['step'].'"' : '';

            // Number and Range case
            if (in_array($vars['type'], ['range'])) {
                $vars['before'] = $vars['before'].' '.$vars['settings']['min'];
                $vars['after']  = $vars['settings']['max'].' '.$vars['after'];
            }
        } else if (in_array($vars['type'], ['email', 'password', 'search', 'tel', 'text'])) {
            $vars['attrs'] .= $vars['settings']['maxlength'] ? ' maxlength="'.$vars['settings']['maxlength'].'"' : '';
            $vars['attrs'] .= $vars['settings']['minlength'] ? ' minlength="'.$vars['settings']['minlength'].'"' : '';
            $vars['attrs'] .= $vars['settings']['multiple'] ? ' multiple' : '';
            $vars['attrs'] .= !empty($vars['settings']['pattern']) ? ' pattern="'.$vars['settings']['pattern'].'"' : '';
            $vars['attrs'] .= $vars['settings']['size'] ? ' size="'.$vars['settings']['size'].'"' : '';
            $vars['attrs'] .= $vars['settings']['spellcheck'] ? ' spellcheck' : '';
        }

        // Custom attributes
        $vars['attrs'] .= ' '.$vars['settings']['attrs'];

        // Update vars
        return $vars;
    }

    /**
     * Define settings.
     *
     * @param  string  $type
     * @param  array   $settings
     *
     * @return array
     */
    protected function getSettingsFromType($type, $settings) : array
    {
        // Default settings
        $defaults = [
            'attrs'      => '',
            'after'      => '',
            'before'     => '',
            'class'      => '',
            'display'    => false,
            'max'        => 0,
            'maxlength'  => 0,
            'min'        => 0,
            'minlength'  => 0,
            'multiple'   => false,
            'pattern'    => '',
            'readonly'   => false,
            'size'       => 0,
            'spellcheck' => false,
            'step'       => 0,
        ];

        // Works on user settings definitions
        if (!empty($settings)) {
            foreach ($settings as $k => $v) {
                if (!isset($defaults[$k])) {
                    continue;
                }

                settype($settings[$k], gettype($defaults[$k]));
            }
        }

        $allcases = [
            'attrs'    => $defaults['attrs'],
            'after'    => $defaults['after'],
            'before'   => $defaults['before'],
            'class'    => $defaults['class'],
            'readonly' => $defaults['readonly'],
        ];

        // Hidden case
        if ('hidden' === $type) {
            $mixed = array_merge([
                'display' => $defaults['display'],
            ], $allcases, $settings);

            return [
                'attrs'    => $mixed['attrs'],
                'after'    => $mixed['after'],
                'before'   => $mixed['before'],
                'class'    => $mixed['class'],
                'display'  => $mixed['display'],
                'readonly' => $mixed['readonly'],
            ];
        }

        // Date and Number cases
        if (in_array($type, ['date', 'datetime-local', 'month', 'number', 'range', 'time', 'week'])) {
            $mixed = array_merge([
                'max'  => $defaults['max'],
                'min'  => $defaults['min'],
                'step' => $defaults['step'],
            ], $allcases, $settings);

            return [
                'attrs'    => $mixed['attrs'],
                'after'    => $mixed['after'],
                'before'   => $mixed['before'],
                'class'    => $mixed['class'],
                'max'      => $mixed['max'],
                'min'      => $mixed['min'],
                'readonly' => $mixed['readonly'],
                'step'     => $mixed['step'],
            ];
        }

        // Default cases
        $mixed = array_merge([
            'maxlength'  => $defaults['maxlength'],
            'minlength'  => $defaults['minlength'],
            'multiple'   => 'email' === $type ? $defaults['multiple'] : false,
            'pattern'    => $defaults['pattern'],
            'size'       => $defaults['size'],
            'spellcheck' => in_array($type, ['email', 'search', 'text']) ? $defaults['spellcheck'] : false,
        ], $allcases, $settings);

        return [
            'attrs'      => $mixed['attrs'],
            'after'      => $mixed['after'],
            'before'     => $mixed['before'],
            'class'      => $mixed['class'],
            'maxlength'  => $mixed['maxlength'],
            'minlength'  => $mixed['minlength'],
            'multiple'   => $mixed['multiple'],
            'pattern'    => $mixed['pattern'],
            'readonly'   => $mixed['readonly'],
            'size'       => $mixed['size'],
            'spellcheck' => $mixed['spellcheck'],
        ];
    }
}
