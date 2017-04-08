
(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* กรุณากรอกข้อมูล",
                    "alertTextCheckboxMultiple": "* กรุณาเลือกตัวเลือก",
                    "alertTextCheckboxe": "* กรุณาเลือก Checkbox"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* อย่างน้อย ",
                    "alertText2": " ตัวอักษร"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* ไม่เกิน ",
                    "alertText2": " ตัวอักษร"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* ข้อมูลไม่ควรต่ำกว่า  "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* ข้อมูลไม่ควรเกิน  "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* Date prior to "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* Date past "
                },	
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* Checks allowed Exceeded"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* กรุณาเลือก ",
                    "alertText2": " ตัวเลือก"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* ข้อมูลไม่ตรงกัน"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/,
                    "alertText": "* หมายเลขโทรศัพท์ไม่ถูกต้อง"
                },
                "email": {
                    // Simplified, was not working in the Iphone browser
                    "regex": /^([A-Za-z0-9_\-\.\'])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,6})$/,
                    "alertText": "* ที่อยู่ E-mail ไม่ถูกต้อง"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* ข้อมูลต้องเป็นตัวเลข จำนวนเต็ม"
                },
                "mac": {
                    "regex": /^([0-9a-fA-F][0-9a-fA-F])+\-([0-9a-fA-F][0-9a-fA-F])+\-([0-9a-fA-F][0-9a-fA-F])+\-([0-9a-fA-F][0-9a-fA-F])+\-([0-9a-fA-F][0-9a-fA-F])+\-([0-9a-fA-F][0-9a-fA-F])+$/,
                    "alertText": "* รูปแบบ 'AA-BB-CC-DD-EE-FF'"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,
                    "alertText": "* ข้อมูลต้องเป็นตัวเลขจำนวนเต็ม หรือ ทศนิยม"
                },
                "date": {
                    // Date in ISO format. Credit: bassistance
                    "regex": /^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/,
                    "alertText": "* รูปแบบวันที่ต้องเป็น YYYY-MM-DD"
                },
                "ipv4": {
                    "regex": /^([1-9][0-9]{0,2})+\.([1-9][0-9]{0,2})+\.([1-9][0-9]{0,2})+\.([1-9][0-9]{0,2})+$/,
                    "alertText": "* IP ไม่ถูกต้อง"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/,
                    "alertText": "* URL ไม่ถูกต้อง"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* ตัวเลขจำนวนเต็ม เท่านั้น"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* ตัวอักษรภาษาอังกฤษเท่านั้น"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* เฉพาะตัวเลข หรือตัวอักษรเท่านั้น"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
               /* "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* กำลังตรวจสอบ กรุณารอสักครู่"
                },
				
                "groupName": {
                    "url": "group/groupexist",
                    // you may want to pass extra data on the ajax call
                    "extraData": "admin",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* กำลังตรวจสอบ กรุณารอสักครู่"
                },*/
                "groupName": {
                    // remote json service location
                    "url": "group/groupexist",
                    // error
                    "alertText": "* This name is already taken",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* This name is available",
                    // speaks by itself
                    "alertTextLoad": "* กำลังตรวจสอบ กรุณารอสักครู่"
                },
                "validate2fields": {
                    "alertText": "* Please input HELLO"
                }
            };
            
        }
    };
    $.validationEngineLanguage.newLang();
})(jQuery);


    
