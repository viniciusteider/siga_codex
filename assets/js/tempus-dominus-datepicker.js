"use strict";

// Class definition
var KTFormsTempusDominusDatepickerDemos = function() {
    // Private functions
    var basicExample = function(element) {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_basic"), {
            //put your config here
        });
    }
    
    var buttonExample = function(element) {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_button"), {
            //put your config here
        });
    }

    var localizationExample = function(element) {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_localization"), {
            localization: {
                locale: "de",
                startOfTheWeek: 1,
                format: "dd/MM/yyyy"
            }
        });
    }

    var timeOnlyExample = function(element) {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_time_only"), {
            display: {
                viewMode: "clock",
                components: {
                    decades: false,
                    year: false,
                    month: false,
                    date: false,
                    hours: true,
                    minutes: true,
                    seconds: false
                }
            }
        });
    }

    var dateOnlyExample = function(element) {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_date_only"), {
            display: {
                viewMode: "calendar",
                components: {
                    decades: true,
                    year: true,
                    month: true,
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            }
        });
    }    

    var linkedPickersExample = function() {
        const linkedPicker1Element = document.getElementById("kt_td_picker_linked_1");
        const linked1 = new tempusDominus.TempusDominus(linkedPicker1Element);
        const linked2 = new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_linked_2"), {
            useCurrent: false,
        });

        //using event listeners
        linkedPicker1Element.addEventListener(tempusDominus.Namespace.events.change, (e) => {
            linked2.updateOptions({
                restrictions: {
                minDate: e.detail.date,
                },
            });
        });

        //using subscribe method
        const subscription = linked2.subscribe(tempusDominus.Namespace.events.change, (e) => {
            linked1.updateOptions({
                restrictions: {
                maxDate: e.date,
                },
            });
        });
    }

    var customIconsExample = function() {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_custom_icons"), {
            display: {
                icons: {
                    time: "ki-solid ki-time fs-3",
                    date: "ki-solid ki-calendar fs-3",
                    up: "ki-solid ki-up fs-3",
                    down: "ki-solid ki-down fs-3",
                    previous: "ki-solid ki-left fs-3",
                    next: "ki-solid ki-right fs-3",
                    today: "ki-solid ki-calendar-tick fs-3",
                    clear: "ki-solid ki-trash fs-3",
                    close: "ki-solid ki-cross fs-2",
                },
                buttons: {
                    today: true,
                    clear: true,
                    close: true,
                },
            }
        });
    }

    var inlineExample = function() {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_inline"), {
            display: {
                inline: true
            }
        });
    }

    var multipleDatesExample = function() {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_multiple_dates"), {
            multipleDates: true
        });
    }

    var modalExample = function(element) {
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_modal"), {
            //put your config here
        });
    }

    return {
        // Public Functions
        init: function(element) {
            basicExample();
            buttonExample();
            localizationExample();
            dateOnlyExample();
            timeOnlyExample();
            linkedPickersExample();
            customIconsExample();
            inlineExample();
            multipleDatesExample();
            modalExample();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTFormsTempusDominusDatepickerDemos.init();
});