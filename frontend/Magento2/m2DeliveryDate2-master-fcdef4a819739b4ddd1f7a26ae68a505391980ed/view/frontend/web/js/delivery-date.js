define([
    'jquery',
    'uiRegistry',
    'Magento_Ui/js/form/element/date',
    'ko',
], function ($, registry, Date, ko) {

    ko.bindingHandlers.datepicker = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            var $el = $(element);

            var initOptions = registry.get('Oye_Deliverydate_initDatepicker')();
            //initialize datepicker with our own options
            $el.datepicker(initOptions);

            if(initOptions.defaultDate)
            {
                $el.datepicker( "setDate", initOptions.defaultDate );
            }

            var writable = valueAccessor();
            if (!ko.isObservable(writable)) {
                var propWriters = allBindingsAccessor()._ko_property_writers;
                if (propWriters && propWriters.datepicker) {
                    writable = propWriters.datepicker;
                } else {
                    return;
                }
            }
            writable($(element).datepicker("getDate"));

        },
        update: function(element, valueAccessor)   {
            var widget = $(element).data("DateTimePicker");
            //when the view model is updated, update the widget
            if (widget) {
                var date = ko.utils.unwrapObservable(valueAccessor());
                widget.date(date);
            }
        }
    };


    return Date;

});