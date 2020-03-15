/*!
 * range.js v0.0.1
 * https://github.com/GetOlympus/olympus-dionysos-field-text
 *
 * This plugin change dynamically the href attribute for the link URL.
 *
 * Example of JS:
 *      $('.links').dionysosRange({
 *          source: '#input-source', // node element of the field sent in form
 *          value: '#input-value',   // node element of the field which displays value
 *      });
 *
 * Example of HTML:
 *      <div class="text">
 *          <input type="range" name="ctm" id="input-source" value="5" min="1" step="1" max="10" />
 *          <input type="number" id="input-value" value="5" min="1" step="1" max="10" />
 *      </div>
 *
 * Copyright 2016 Achraf Chouk
 * Achraf Chouk (https://github.com/crewstyle)
 */

(function ($){
    "use strict";

    /**
     * Constructor
     * @param {nodeElement} $el
     * @param {array}       options
     */
    var Range = function ($el,options){
        // vars
        var _this = this;

        _this.$el = $el;
        _this.options = options;

        // update elements
        _this.$source = _this.$el.find(_this.options.source);
        _this.$value  = _this.$el.find(_this.options.value);

        // bind click event
        _this.$source.on('change', $.proxy(_this.change_source, _this));
        _this.$value.on('change', $.proxy(_this.change_value, _this));
    };

    /**
     * Main element
     * @type {nodeElement}
     */
    Range.prototype.$el = null;

    /**
     * Source input
     * @type {nodeElement}
     */
    Range.prototype.$source = null;

    /**
     * Value input
     * @type {nodeElement}
     */
    Range.prototype.$value = null;

    /**
     * onChange event status
     * @type {bool}
     */
    Range.prototype.changing = false;

    /**
     * Main options array
     * @type {array}
     */
    Range.prototype.options = null;

    /**
     * Fires change event on source input
     * @param {event} e
     */
    Range.prototype.change_source = function (e){
        e.preventDefault();
        var _this = this;

        // check status
        if (_this.changing) {
            return;
        }

        // update values
        _this.update_values(_this.$source.val(), 'source');
    };

    /**
     * Fires change event on value input
     * @param {event} e
     */
    Range.prototype.change_value = function (e){
        e.preventDefault();
        var _this = this;

        // check status
        if (_this.changing) {
            return;
        }

        // update values
        _this.update_values(_this.$value.val(), 'value');
    };

    /**
     * Update values in all inputs
     * @param {int}    value
     * @param {string} input
     */
    Range.prototype.update_values = function (value, input){
        var _this = this;

        // update status
        _this.changing = true;

        // update values
        if (input !== 'source') {
            _this.$source.val(value);
        }
        if (input !== 'value') {
            _this.$value.val(value);
        }

        // update status
        _this.changing = false;
    };

    var methods = {
        init: function (options){
            if (!this.length) {
                return false;
            }

            var settings = {
                // fields
                source: '#input-source',
                value: '#input-value',
            };

            return this.each(function (){
                if (options) {
                    $.extend(settings, options);
                }

                new Range($(this), settings);
            });
        }
    };

    $.fn.dionysosRange = function (method){
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }
        else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        }
        else {
            $.error('Method '+method+' does not exist on dionysosRange');
            return false;
        }
    };
})(window.jQuery);
