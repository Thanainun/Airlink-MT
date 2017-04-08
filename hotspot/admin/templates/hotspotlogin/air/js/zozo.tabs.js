


/* 
*	@name							Zozo UI Tabs
*	@descripton						Create awesome tabbed content area
*	@version						2.2
*	@copyright                      Copyright (c) 2012 Zozo UI, http://www.zozoui.com 
*/
(function ($, window, document, undefined) {
    if (!window.console) window.console = {};
    if (!window.console.log) window.console.log = function () { };

    $.fn.extend({
        hasClasses: function (selectors) {
            var _base = this;
            for (i in selectors) {
                if ($(_base).hasClass(selectors[i]))
                    return true;
            }
            return false;
        }
    });

    $.zozo = {};
    $.zozo.core = {};
    $.zozo.core.console = {
        log: function (message) {
            if ($("#console").length != 0) {
                $("<div/>")
                .css({ marginTop: -24 })
                .html(message)
                .prependTo("#console")
                .animate({ marginTop: 0 }, 300)
                .animate({ backgroundColor: "#ffffff" }, 800);
            }
            else {
                if (console) {
                    console.log(message);
                }
            }
        }
    };

    $.zozo.core.keyCodes = {
        tab: 9,
        enter: 13,
        esc: 27,

        space: 32,
        pageup: 33,
        pagedown: 34,
        end: 35,
        home: 36,

        left: 37,
        up: 38,
        right: 39,
        down: 40
    };

    $.zozo.core.debug = {
        startTime: new Date(),
        log: function (msg) {
            if (console) {
                console.log(msg);
            }
        },
        start: function () {
            this.startTime = +new Date();
            this.log("start: " + this.startTime);
        },
        stop: function () {
            var _end = +new Date();
            var _diff = _end - this.startTime;

            this.log("end: " + _end);
            this.log("diff: " + _diff);

            var Seconds_from_T1_to_T2 = _diff / 1000;
            var Seconds_Between_Dates = Math.abs(Seconds_from_T1_to_T2);

            //this.log("diff s: " + Seconds_Between_Dates);
        }
    };

    $.zozo.core.plugins = {
        easing: function (_base) {
            var _exist = false;
            if (_base) {
                if (_base.settings) {
                    //set up a default value for easing
                    var _defEasing = 'swing';

                    // check for the existence of the easing plugin
                    if ($.easing.def) {
                        _exist = true;
                    }
                    else {
                        if (_base.settings.animation.easing != 'swing' && _base.settings.animation.easing != 'linear') {
                            _base.settings.animation.easing = _defEasing;
                        }
                    }
                }
            }
            return _exist;
        }
    };

    $.zozo.core.browser = {
        init: function () {
            this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
            this.version = this.searchVersion(navigator.userAgent)
                           || this.searchVersion(navigator.appVersion)
                           || "an unknown version";

            $.zozo.core.console.log("init: " + this.browser + " : " + this.version);
            if (this.browser === "Explorer") {

                var _el = $("html");
                var version = parseInt(this.version);

                if (version === 6) {
                    _el.addClass("ie ie7");
                }
                else if (version === 7) {
                    _el.addClass("ie ie7");
                }
                else if (version === 8) {
                    _el.addClass("ie ie8");
                }
                else if (version === 9) {
                    _el.addClass("ie ie9");
                }
            }
        },
        searchString: function (data) {
            for (var i = 0; i < data.length; i++) {
                var dataString = data[i].string;
                var dataProp = data[i].prop;
                this.versionSearchString = data[i].versionSearch || data[i].identity;
                if (dataString) {
                    if (dataString.indexOf(data[i].subString) != -1)
                        return data[i].identity;
                }
                else if (dataProp)
                    return data[i].identity;
            }
        },
        searchVersion: function (dataString) {
            var index = dataString.indexOf(this.versionSearchString);
            if (index == -1)
                return;
            return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
        },
        dataBrowser: [
            {
                string: navigator.userAgent,
                subString: "Chrome",
                identity: "Chrome"
            }, {
                string: navigator.vendor,
                subString: "Apple",
                identity: "Safari",
                versionSearch: "Version"
            }, {
                prop: window.opera,
                identity: "Opera"
            }, {
                string: navigator.userAgent,
                subString: "Firefox",
                identity: "Firefox"
            }, {
                string: navigator.userAgent,
                subString: "MSIE",
                identity: "Explorer",
                versionSearch: "MSIE"
            }
        ]
    };

    $.zozo.core.hashHelper = {
        all: function () {
            var hashArray = [];
            var hash = document.location.hash;

            if (!this.hasHash()) {
                return hashArray;
            }

            hash = hash.substring(1).split('&');

            for (var i = 0; i < hash.length; i++) {
                var match = hash[i].split('=');
                //if (match.length != 2 || match[0] in hashArray) return undefined;
                if (match.length != 2 || match[0] in hashArray) {
                    match[1] = "none";
                }
                hashArray[match[0]] = match[1];
            }

            return hashArray;
        },
        get: function (key) {
            var all = this.all();

            if (typeof all === 'undefined' || typeof all.length < 0) {
                //self.log("get: undefined or null all");
                return null;
            }
            else {
                if (typeof all[key] !== 'undefined' && all[key] !== null) {
                    //self.log("get: exist key");
                    return all[key];
                }
                else {
                    //self.log("get: undefined or null key" + key);
                    return null;
                }
            }

        },
        set: function (key, value) {
            var all = this.all();
            var hash = [];

            all[key] = value;
            for (var key in all) {
                hash.push(key + '=' + all[key]);
            }
            document.location.hash = hash.join('&');
        },
        hasHash: function () {
            var hash = document.location.hash;
            if (hash.length > 0) {
                return true;
            }
            else {
                return false;
            }
        }
    };



    $.zozo.core.browser.init();

})(jQuery, window, document);


;(function ($, window, document, undefined) {    
    if (window.zozo == null) {
        window.zozo = {};
    }
    var ZozoTabs = function (elem, options) {
        this.elem = elem;
        this.$elem = $(elem);
        this.options = options;
        this.metadata = (this.$elem.data("options")) ? this.$elem.data("options") : {};
        this.attrdata = (this.$elem.data()) ? this.$elem.data() : {};
        this.tabID;
        this.$tabGroup;
        this.$tabs;
        this.$container;
        this.$contents;
        this.autoplayIntervalId;
        this.currentTab;
        this.BrowserDetection = $.zozo.core.browser;
        this.Hash = $.zozo.core.hashHelper;
    };

    var zozo = {
        pluginName: "zozoTabs",
        elementSpacer: "<span class='z-tab-spacer' style='clear: both;display: block;'></span>",        
        commaRegExp: /,/g,
        space: " ",
        classes: {
            prefix: "z-",
            wrapper: "z-tabs",
            tabGroup: "z-tabs-nav",
            tab: "z-tab",
            first: "z-first",
            last: "z-last",
            active: "z-active",
            link: "z-link",
            container: "z-container",
            content: "z-content",
            shadows: "z-shadows",
            rounded: "z-rounded",
            themes: {
                gray: "gray",
                black: "black",
                blue: "blue",
                crystal: "crystal",
                green: "green",
                silver: "silver",
                red: "red",
                orange: "orange",
                deepblue: "deepblue",
                white: "white"
            },
            styles: {
                normal: "normal",
                underlined: "underlined",
                simple: "simple"
            },
            orientations: {
                vertical: "vertical",
                horizontal: "horizontal"
            },
            sizes: {
                mini: "mini",
                small: "small",
                medium: "medium",
                large: "large",
                xlarge: "xlarge",
                xxlarge: "xxlarge"
            },
            positions: {
                topLeft: "top-left",
                topCenter: "top-center",
                topRight: "top-right",
                topCompact: "top-compact",
                bottomLeft: "bottom-left",
                bottomCenter: "bottom-center",
                bottomRight: "bottom-right",
                bottomCompact: "bottom-compact"
            }
        }
    };

    ZozoTabs.prototype = {
        defaults: {
            animation: { duration: 200, effects: "fadeIn", easing: "swing" },
            autoplay: { interval: 0 },           
            defaultTab: "tab1",
            event: "click",
            hashAttribute: "data-link",            
            position: zozo.classes.positions.topLeft,
            orientation: zozo.classes.orientations.horizontal,            
            rounded: true,
            shadows: true,
            tabWidth: 150,
            tabHeight: 51,
            theme: zozo.classes.themes.silver,
            urlBased: false,
            select: function (tab, content) { },
            size: zozo.classes.sizes.medium,
            style: zozo.classes.styles.normal
        },
        init: function () {
            var _base = this;
            
           
            _base.settings = $.extend(true,{}, _base.defaults, _base.options, _base.metadata, _base.attrdata);

            methods.updateClasses(_base);
            methods.bindEvents(_base);

            // check if url based is enabled
            if (_base.settings.urlBased === true) {
                if (document.location.hash) {
                    var tab = _base.Hash.get(_base.tabID);
                    if (tab != null) {
                        methods.showTab(_base, tab);
                    }
                    else {
                        methods.showTab(_base, _base.settings.defaultTab);
                    }
                }
                else {
                    methods.showTab(_base, _base.settings.defaultTab);
                }

                // bind the event hashchange, using jquery-hashchange-plugin
                if (typeof ($(window).hashchange) != "undefined") {
                    $(window).hashchange(function () {
                        //methods.log("even: hashchange (plugin)");
                        //window.zozo.debug.start();
                        var _newTab = _base.Hash.get(_base.tabID);                        
                        if (_base.currentTab.attr(_base.settings.hashAttribute) !== _newTab) {
                            methods.showTab(_base, _newTab);
                        }
                        //window.zozo.debug.stop();
                    });
                }
                else {
                    // Bind the event hashchange, using jquery event binding, not supported (IE6, IE7) 
                    $(window).bind('hashchange', function () {
                        //methods.log("even: hashchange (native)");

                        //window.zozo.debug.start();
                        var _newTab = _base.Hash.get(_base.tabID);
                        if (_base.currentTab.attr(_base.settings.hashAttribute) !== _newTab) {
                            methods.showTab(_base, _newTab);
                        }
                        //window.zozo.debug.stop();
                    });
                }
            }
            else {
                methods.showTab(_base, _base.settings.defaultTab);
            }

            methods.initAutoPlay(_base);

            return this;
        },
        setOptions: function (_option) {
            var _base = this;
           
            _base.settings = $.extend(true,_base.settings, _option);

            methods.updateClasses(_base);
            methods.initAutoPlay(_base);            
            return _base;
        },
        add: function (_t, _c) {          
            var _base = this;
            var _insertedTab = methods.create(_t, _c);

            _insertedTab.tab
                .appendTo(_base.$tabGroup)
                .hide()
                .fadeIn(500);

            _insertedTab.content
                .appendTo(_base.$container);

            methods.updateClasses(_base);
            methods.bindEvent(_base, _insertedTab.tab);
            return _base;
        },
        remove: function (_i) {            
            var _base = this;
            var _index = (_i - 1);
            var _tabToRemove = _base.$tabs.eq(_index);
            var _contentToRmove = _base.$contents.eq(_index);

            _contentToRmove.remove();
            _tabToRemove.fadeOut(500, function () {
                $(this).remove();
                methods.updateClasses(_base);
            });

            return _base;
        },
        select: function (_i) {
            var _base = this;
            methods.changeHash(_base, _base.$elem.find("> ul > li").eq(_i - 1).attr(_base.settings.hashAttribute));
            return _base;
        },
        first: function () {
            var _base = this;
            _base.select(methods.getFirst());
            return _base;
        },
        prev: function () {
            var _base = this;
            var currentIndex = parseInt(_base.currentTab.index()) + 1;

            if (currentIndex <= methods.getFirst(_base)) {
                _base.select(methods.getLast(_base));
            }
            else {
                _base.select(currentIndex - 1);
                methods.log("prev tab : " + (currentIndex - 1));
            }
            return _base;
        },
        next: function (_base) {
            _base = (_base) ? _base : this;
            var _currentIndex = parseInt(_base.currentTab.index()) + 1;
            var _count = parseInt(_base.$tabGroup.children("li").size());

            if (_currentIndex >= _count) {
                _base.select(methods.getFirst());
            }
            else {
                _base.select(_currentIndex + 1);
                methods.log("next tab : " + (_currentIndex + 1));
            }
            return _base;
        },
        last: function () {
            var _base = this;
            _base.select(methods.getLast(_base));
            return _base;
        },
        play: function (interval) {
            var _base = this;
            if (interval == null || interval < 0) {
                interval = 2000;
            }
            _base.settings.autoplay.interval = interval;
            _base.stop();
            _base.autoplayIntervalId = setInterval(function () { _base.next(_base); }, _base.settings.autoplay.interval);

            return _base;
        },
        stop: function (_base) {
            _base = (_base) ? _base : this;
            clearInterval(_base.autoplayIntervalId);
            return _base;
        }
    };

    var methods = {
        log: function (msg) {
            if (console) {
                console.log(msg);
            }
        },
        isEmpty: function (_str) {
            return (!_str || 0 === _str.length);
        },
        updateClasses: function (_base) {
            _base.tabID = _base.$elem.attr("id");
            _base.$tabGroup = _base.$elem.find("> ul").addClass(zozo.classes.tabGroup);
            _base.$tabs = _base.$tabGroup.find("> li");
            _base.$container = _base.$elem.find("> div");
            _base.$contents = _base.$container.find("> div");

            //update container and content classes 
            _base.$container.addClass(zozo.classes.container);
            _base.$contents.addClass(zozo.classes.content);

            //update li classes 
            _base.$tabs.each(function (index, item) {
                $(item)
                    .removeClass(zozo.classes.first)
                    .removeClass(zozo.classes.last)
                    .attr(_base.settings.hashAttribute, "tab" + (index + 1))
                    .addClass(zozo.classes.tab)
                    .find("a")
                    .addClass(zozo.classes.link);
            });

            //update first and last
            _base.$tabs.filter(zozo.classes.first + ":not(:first-child)").removeClass(zozo.classes.first);
            _base.$tabs.filter(zozo.classes.last + ":not(:last-child)").removeClass(zozo.classes.last);
            _base.$tabs.filter("li:first-child").addClass(zozo.classes.first);
            _base.$tabs.filter("li:last-child").addClass(zozo.classes.last);

            var _styles = methods.toArray(zozo.classes.styles);
            var _themes = methods.toArray(zozo.classes.themes);
            var _sizes = methods.toArray(zozo.classes.sizes);
            var _positions = methods.toArray(zozo.classes.positions);
            
            _base.$elem
                .removeClass(zozo.classes.wrapper)
                .removeClass(zozo.classes.orientations.vertical)
                .removeClass(zozo.classes.orientations.horizontal)
                .removeClass(zozo.classes.rounded)
                .removeClass(zozo.classes.shadows)
                .removeClass(_styles.join().replace(zozo.commaRegExp, zozo.space))
                .removeClass(_positions.join().replace(zozo.commaRegExp, zozo.space))
                .removeClass(_sizes.join().replace(zozo.commaRegExp, zozo.space))
                .addClass(_base.settings.style)
                .addClass(_base.settings.size);

           

            // check theme
            if (!methods.isEmpty(_base.settings.theme)) {
                _base.$elem
                    .removeClass(_themes.join().replace(zozo.commaRegExp, zozo.space))
                    .addClass(_base.settings.theme);
            }
            else {
                if (!_base.$elem.hasClasses(_themes)) {
                    _base.$elem.addClass(zozo.classes.themes.silver);
                }
            }

            //rounded
            if (_base.settings.rounded === true) {
                _base.$elem.addClass(zozo.classes.rounded);
            }

            if (_base.settings.shadows === true) {
                _base.$elem.addClass(zozo.classes.shadows);
            }

            methods.checkPosition(_base);
        },
        checkPosition: function (_base) {
            _base.$container.appendTo(_base.$elem);
            _base.$tabGroup.prependTo(_base.$elem);
            _base.$elem.find("> span.z-tab-spacer").remove();
            _base.$elem.addClass(zozo.classes.wrapper);
            
            
            if (_base.settings.orientation === zozo.classes.orientations.vertical) {
                _base.$elem.addClass(zozo.classes.orientations.vertical);

                var _height = _base.settings.tabHeight;

                switch (_base.settings.size) {
                    case zozo.classes.sizes.mini: _height = 33; break;
                    case zozo.classes.sizes.small: _height = 39; break;
                    case zozo.classes.sizes.medium: _height = 45; break;
                    case zozo.classes.sizes.large: _height = 51; break;
                    case zozo.classes.sizes.xlarge: _height = 57; break;
                    case zozo.classes.sizes.xxlarge: _height = 63; break;                    
                    default: _height = 45;
                }

                var _tabCount = parseInt(_base.$tabGroup.children("li").size());
                var _containerSize = _height * _tabCount - 1;

                _base.$container.css({
                    'min-height': _containerSize,
                    'padding': 0,
                    'margin-top': 0,
                    'margin-bottom': 0
                });
                if (_base.settings.position !== zozo.classes.positions.topRight) {
                    _base.settings.position = zozo.classes.positions.topLeft;
                }
            }
            else {
                _base.settings.orientation = zozo.classes.orientations.horizontal;
                _base.$elem.addClass(zozo.classes.orientations.horizontal);
                if (_base.settings.position === zozo.classes.positions.bottomLeft
                    || _base.settings.position === zozo.classes.positions.bottomCenter
                    || _base.settings.position === zozo.classes.positions.bottomRight
                    || _base.settings.position === zozo.classes.positions.bottomCompact) {
                    _base.$tabGroup.appendTo(_base.$elem);
                    $(zozo.elementSpacer).appendTo(_base.$elem);
                    _base.$container.prependTo(_base.$elem);
                }
            }
            if (_base.settings.position === zozo.classes.positions.topCompact || _base.settings.position === zozo.classes.positions.bottomCompact) {
                var count = parseInt(_base.$tabGroup.children("li").size());
                var groupWidth = _base.settings.tabWidth * count;
                   
              

                switch (_base.BrowserDetection.browser) {                        
                    case "Firefox":   break;

                    case "Explorer": 
                        switch (_base.BrowserDetection.version) {
                            case 7: groupWidth = groupWidth + 1; break;                                                            
                            default:       
                        }
                    break;

                    default: groupWidth = groupWidth + 1;
                }

                _base.$elem.css("width", groupWidth + "px");
                _base.$tabs.each(function (index, item) {
                    $(item).css("width", _base.settings.tabWidth + "px");
                });
            }
            else {
                _base.$elem.css("width", "");
                _base.$tabs.each(function (index, item) {
                    $(item).css("width", "");
                });
            }

            _base.$elem.addClass(_base.settings.position);
        },
        bindEvents: function (_base) {
            _base.$tabs.each(function () {
                methods.bindEvent(_base, $(this));
            });
        },
        bindEvent: function (_base, _tab) {
            _tab.on(_base.settings.event, function () {
                _base.stop();               
                methods.changeHash(_base, _tab.attr(_base.settings.hashAttribute));                
            });
        },
        showTab: function (_base, tab) {
            if (tab != null) {
                _base.$tabs.removeClass(zozo.classes.active);
                _base.currentTab = _base.$tabs.filter("li[" + _base.settings.hashAttribute + "=" + tab + "]");
                _base.currentTab.addClass(zozo.classes.active);
               
                // get current tab index
                var index = _base.$tabs.index(_base.currentTab);

                // hide all content divs and show current one                
                if (_base.settings.animation !== false && _base.settings.animation != null) {
                    if (_base.settings.animation.effects === "fadeIn") {
                        _base.$contents.removeClass(zozo.classes.active).hide().eq(index).addClass(zozo.classes.active).fadeIn(_base.settings.animation.duration, _base.settings.animation.easing);
                    }
                    else if (_base.settings.animation.effects === "slideDown") {
                        _base.$contents.removeClass(zozo.classes.active).slideUp(200).eq(index).addClass(zozo.classes.active).slideDown(_base.settings.animation.duration, _base.settings.animation.easing);
                    }
                    else if (_base.settings.animation.effects === "slideToggle") {
                        _base.$contents.removeClass(zozo.classes.active).hide().eq(index).addClass(zozo.classes.active).slideToggle(_base.settings.animation.duration, _base.settings.animation.easing);
                    }
                    else if (_base.settings.animation.effects === "fadeToggle") {
                        _base.$contents.removeClass(zozo.classes.active).hide().eq(index).addClass(zozo.classes.active).fadeToggle(_base.settings.animation.duration, _base.settings.animation.easing);
                    }
                    else if (_base.settings.animation.effects === "slideUp") {
                        _base.$contents.removeClass(zozo.classes.active).slideUp(200).eq(index).addClass(zozo.classes.active).slideDown(_base.settings.animation.duration, _base.settings.animation.easing);
                    }
                }
                else {
                    _base.$contents.removeClass(zozo.classes.active).hide().eq(index).addClass(zozo.classes.active).show();
                }

                if (typeof _base.settings.select == 'function') {
                    _base.settings.select.call(this, _base.currentTab, _base.$contents.eq(index));
                }
            }
        },
        initAutoPlay: function (_base) {
            if (_base.settings.autoplay !== false && _base.settings.autoplay != null) {
                if (_base.settings.autoplay.interval > 0) {
                    _base.stop();
                    _base.autoplayIntervalId = setInterval(function () { _base.next(_base); }, _base.settings.autoplay.interval);
                } else {
                    _base.stop();
                }
            }
            else {
                _base.stop();
            }
        },
        changeHash: function (_base, tab) {
            if (_base.settings.urlBased === true) {
                if (typeof ($(window).hashchange) != "undefined") {                    
                    //window.zozo.debug.start();
                    _base.Hash.set(_base.tabID, tab);
                    //window.zozo.debug.stop();
                }
                else {
                    methods.log("browser: " + _base.BrowserDetection.browser + " version: " + _base.BrowserDetection.version);
                    if (_base.BrowserDetection.browser === "Explorer" && _base.BrowserDetection.version <= 7) {
                        //IE and browsers that don't support hashchange
                        methods.log("IE");
                        methods.showTab(_base, tab);
                    }
                    else {
                        //modern browsers                        
                        _base.Hash.set(_base.tabID, tab);
                    }
                }
            }
            else {
                methods.showTab(_base, tab);
            }
        },
        getFirst: function (_base) {
            return 1;
        },
        getLast: function (_base) {
            return parseInt(_base.$tabGroup.children("li").size());
        },
        create: function (_t, _c) {
            var _tab = $("<li><a>" + _t + "</a></li>");
            var _content = $("<div>" + _c + "</div>");

            return { tab: _tab, content: _content };
        },
        toArray: function (_object) {
            return $.map(_object, function (value, key) {
                return value;
            });
        }
    };

    ZozoTabs.defaults = ZozoTabs.prototype.defaults;

    $.fn.zozoTabs = function (options) {
        return this.each(function () {
            if (undefined == $(this).data(zozo.pluginName)) {
                var zozoTabs = new ZozoTabs(this, options).init();
                $(this).data(zozo.pluginName, zozoTabs);
            }
        });
    };

    window.zozo.tabs = ZozoTabs;
  
    $(document).ready(function () {
        $("[data-role='z-tabs']").each(function (index, item) {
            if (!$(item).zozoTabs()) {
                $(item).zozoTabs();
            }
        });
    });
})(jQuery, window, document);