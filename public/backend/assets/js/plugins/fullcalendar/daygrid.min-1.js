/*!
FullCalendar v5.3.0
Docs & License: https://fullcalendar.io/
(c) 2020 Adam Shaw
*/
var FullCalendarDayGrid=function(e,t){"use strict";var n=function(e,t){return(n=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n])})(e,t)};function r(e,t){function r(){this.constructor=e}n(e,t),e.prototype=null===t?Object.create(t):(r.prototype=t.prototype,new r)}var o=function(){return(o=Object.assign||function(e){for(var t,n=1,r=arguments.length;n<r;n++)for(var o in t=arguments[n])Object.prototype.hasOwnProperty.call(t,o)&&(e[o]=t[o]);return e}).apply(this,arguments)};var a=function(e){function n(){var n=null!==e&&e.apply(this,arguments)||this;return n.headerElRef=t.createRef(),n}return r(n,e),n.prototype.renderSimpleLayout=function(e,n){var r=this.props,o=this.context,a=[],i=t.getStickyHeaderDates(o.options);return e&&a.push({type:"header",key:"header",isSticky:i,chunk:{elRef:this.headerElRef,tableClassName:"fc-col-header",rowContent:e}}),a.push({type:"body",key:"body",liquid:!0,chunk:{content:n}}),t.createElement(t.ViewRoot,{viewSpec:o.viewSpec},(function(e,n){return t.createElement("div",{ref:e,className:["fc-daygrid"].concat(n).join(" ")},t.createElement(t.SimpleScrollGrid,{liquid:!r.isHeightAuto&&!r.forPrint,cols:[],sections:a}))}))},n.prototype.renderHScrollLayout=function(e,n,r,o){var a=this.context.pluginHooks.scrollGridImpl;if(!a)throw new Error("No ScrollGrid implementation");var i=this.props,s=this.context,l=!i.forPrint&&t.getStickyHeaderDates(s.options),c=!i.forPrint&&t.getStickyFooterScrollbar(s.options),d=[];return e&&d.push({type:"header",key:"header",isSticky:l,chunks:[{key:"main",elRef:this.headerElRef,tableClassName:"fc-col-header",rowContent:e}]}),d.push({type:"body",key:"body",liquid:!0,chunks:[{key:"main",content:n}]}),c&&d.push({type:"footer",key:"footer",isSticky:!0,chunks:[{key:"main",content:t.renderScrollShim}]}),t.createElement(t.ViewRoot,{viewSpec:s.viewSpec},(function(e,n){return t.createElement("div",{ref:e,className:["fc-daygrid"].concat(n).join(" ")},t.createElement(a,{liquid:!i.isHeightAuto&&!i.forPrint,colGroups:[{cols:[{span:r,minWidth:o}]}],sections:d}))}))},n}(t.DateComponent);function i(e,t){for(var n=[],r=0;r<t;r++)n[r]=[];for(var o=0,a=e;o<a.length;o++){var i=a[o];n[i.row].push(i)}return n}function s(e,t){for(var n=[],r=0;r<t;r++)n[r]=[];for(var o=0,a=e;o<a.length;o++){var i=a[o];n[i.firstCol].push(i)}return n}function l(e,t){var n=[];if(e){for(i=0;i<t;i++)n[i]={affectedInstances:e.affectedInstances,isEvent:e.isEvent,segs:[]};for(var r=0,o=e.segs;r<o.length;r++){var a=o[r];n[a.row].segs.push(a)}}else for(var i=0;i<t;i++)n[i]=null;return n}var c=t.createFormatter({week:"narrow"}),d=function(e){function n(){var n=null!==e&&e.apply(this,arguments)||this;return n.handleRootEl=function(e){n.rootEl=e,t.setRef(n.props.elRef,e)},n.handleMoreLinkClick=function(e){var t=n.props;if(t.onMoreClick){var r=t.segsByEachCol,o=r.filter((function(e){return t.segIsHidden[e.eventRange.instance.instanceId]}));t.onMoreClick({date:t.date,allSegs:r,hiddenSegs:o,moreCnt:t.moreCnt,dayEl:n.rootEl,ev:e})}},n}return r(n,e),n.prototype.render=function(){var e=this,n=this.context,r=n.options,a=n.viewApi,i=this.props,s=i.date,l=i.dateProfile,d={num:i.moreCnt,text:i.buildMoreLinkText(i.moreCnt),view:a},u=r.navLinks?{"data-navlink":t.buildNavLinkData(s,"week"),tabIndex:0}:{};return t.createElement(t.DayCellRoot,{date:s,dateProfile:l,todayRange:i.todayRange,showDayNumber:i.showDayNumber,extraHookProps:i.extraHookProps,elRef:this.handleRootEl},(function(n,a,g,h){return t.createElement("td",o({ref:n,className:["fc-daygrid-day"].concat(a,i.extraClassNames||[]).join(" ")},g,i.extraDataAttrs),t.createElement("div",{className:"fc-daygrid-day-frame fc-scrollgrid-sync-inner",ref:i.innerElRef},i.showWeekNumber&&t.createElement(t.WeekNumberRoot,{date:s,defaultFormat:c},(function(e,n,r,a){return t.createElement("a",o({ref:e,className:["fc-daygrid-week-number"].concat(n).join(" ")},u),a)})),!h&&t.createElement(p,{date:s,dateProfile:l,showDayNumber:i.showDayNumber,forceDayTop:i.forceDayTop,todayRange:i.todayRange,extraHookProps:i.extraHookProps}),t.createElement("div",{className:"fc-daygrid-day-events",ref:i.fgContentElRef,style:{paddingBottom:i.fgPaddingBottom}},i.fgContent,Boolean(i.moreCnt)&&t.createElement("div",{className:"fc-daygrid-day-bottom",style:{marginTop:i.moreMarginTop}},t.createElement(t.RenderHook,{hookProps:d,classNames:r.moreLinkClassNames,content:r.moreLinkContent,defaultContent:f,didMount:r.moreLinkDidMount,willUnmount:r.moreLinkWillUnmount},(function(n,r,o,a){return t.createElement("a",{onClick:e.handleMoreLinkClick,ref:n,className:["fc-daygrid-more-link"].concat(r).join(" ")},a)})))),t.createElement("div",{className:"fc-daygrid-day-bg"},i.bgContent)))}))},n}(t.DateComponent);function u(e){return e.dayNumberText}function f(e){return e.text}var p=function(e){function n(){return null!==e&&e.apply(this,arguments)||this}return r(n,e),n.prototype.render=function(){var e=this.props,n=this.context.options.navLinks?{"data-navlink":t.buildNavLinkData(e.date),tabIndex:0}:{};return t.createElement(t.DayCellContent,{date:e.date,dateProfile:e.dateProfile,todayRange:e.todayRange,showDayNumber:e.showDayNumber,extraHookProps:e.extraHookProps,defaultContent:u},(function(r,a){return(a||e.forceDayTop)&&t.createElement("div",{className:"fc-daygrid-day-top",ref:r},t.createElement("a",o({className:"fc-daygrid-day-number"},n),a||t.createElement(t.Fragment,null," ")))}))},n}(t.BaseComponent),g=t.createFormatter({hour:"numeric",minute:"2-digit",omitZeroMinute:!0,meridiem:"narrow"});function h(e){var t=e.eventRange.ui.display;return"list-item"===t||"auto"===t&&!e.eventRange.def.allDay&&e.firstCol===e.lastCol&&e.isStart&&e.isEnd}var v=function(e){function n(){return null!==e&&e.apply(this,arguments)||this}return r(n,e),n.prototype.render=function(){var e=this.props,n=this.context,r=n.options.eventTimeFormat||g,a=t.buildSegTimeText(e.seg,r,n,!0,e.defaultDisplayEventEnd);return t.createElement(t.EventRoot,{seg:e.seg,timeText:a,defaultContent:m,isDragging:e.isDragging,isResizing:!1,isDateSelecting:!1,isSelected:e.isSelected,isPast:e.isPast,isFuture:e.isFuture,isToday:e.isToday},(function(n,r,a,i){return t.createElement("a",o({className:["fc-daygrid-event","fc-daygrid-dot-event"].concat(r).join(" "),ref:n},(s=e.seg,(l=s.eventRange.def.url)?{href:l}:{})),i);var s,l}))},n}(t.BaseComponent);function m(e){return t.createElement(t.Fragment,null,t.createElement("div",{className:"fc-daygrid-event-dot",style:{borderColor:e.borderColor||e.backgroundColor}}),e.timeText&&t.createElement("div",{className:"fc-event-time"},e.timeText),t.createElement("div",{className:"fc-event-title"},e.event.title||t.createElement(t.Fragment,null," ")))}var y=function(e){function n(){return null!==e&&e.apply(this,arguments)||this}return r(n,e),n.prototype.render=function(){var e=this.props;return t.createElement(t.StandardEvent,o({},e,{extraClassNames:["fc-daygrid-event","fc-daygrid-block-event","fc-h-event"],defaultTimeFormat:g,defaultDisplayEventEnd:e.defaultDisplayEventEnd,disableResizing:!e.seg.eventRange.def.allDay}))},n}(t.BaseComponent);function E(e,n,r,a,i,s,l,c){for(var d=[],u=[],f={},p={},g={},h={},v={},m=0;m<l;m++)d.push([]),u.push(0);for(var y=0,E=n=t.sortEventSegs(n,c);y<E.length;y++){P(M=E[y],i[M.eventRange.instance.instanceId+":"+M.firstCol]||0)}!0===r||!0===a?function(e,t,n,r){C(e,t,n,!0,(function(e){return e.bottom<=r}))}(u,f,d,s):"number"==typeof r?function(e,t,n,r){C(e,t,n,!1,(function(e,t){return t<r}))}(u,f,d,r):"number"==typeof a&&function(e,t,n,r){C(e,t,n,!0,(function(e,t){return t<r}))}(u,f,d,a);for(var S=0;S<l;S++){for(var b=0,k=0,D=0,w=d[S];D<w.length;D++){var M,x=w[D];f[(M=x.seg).eventRange.instance.instanceId]||(p[M.eventRange.instance.instanceId]=x.top,M.firstCol===M.lastCol&&M.isStart&&M.isEnd?(g[M.eventRange.instance.instanceId]=x.top-b,k=0,b=x.bottom):k+=x.bottom-x.top)}k&&(u[S]?h[S]=k:v[S]=k)}function P(e,t){if(!N(e,t,0))for(var n=e.firstCol;n<=e.lastCol;n++)for(var r=0,o=d[n];r<o.length;r++){if(N(e,t,o[r].bottom))return}}function N(e,t,n){if(function(e,t,n){for(var r=e.firstCol;r<=e.lastCol;r++)for(var o=0,a=d[r];o<a.length;o++){var i=a[o];if(n<i.bottom&&n+t>i.top)return!1}return!0}(e,t,n)){for(var r=e.firstCol;r<=e.lastCol;r++){for(var o=d[r],a=0;a<o.length&&n>=o[a].top;)a++;o.splice(a,0,{seg:e,top:n,bottom:n+t})}return!0}return!1}for(var H in i)i[H]||(f[H.split(":")[0]]=!0);return{segsByFirstCol:d.map(R),segsByEachCol:d.map((function(n,r){var a=function(e){for(var t=[],n=0,r=e;n<r.length;n++){var o=r[n];t.push(o.seg)}return t}(n);return a=function(e,n,r){for(var a=n,i=t.addDays(a,1),s={start:a,end:i},l=[],c=0,d=e;c<d.length;c++){var u=d[c],f=u.eventRange,p=f.range,g=t.intersectRanges(p,s);g&&l.push(o(o({},u),{firstCol:r,lastCol:r,eventRange:{def:f.def,ui:o(o({},f.ui),{durationEditable:!1}),instance:f.instance,range:g},isStart:u.isStart&&g.start.valueOf()===p.start.valueOf(),isEnd:u.isEnd&&g.end.valueOf()===p.end.valueOf()}))}return l}(a,e[r].date,r)})),segIsHidden:f,segTops:p,segMarginTops:g,moreCnts:u,moreTops:h,paddingBottoms:v}}function R(e,t){for(var n=[],r=0,o=e;r<o.length;r++){var a=o[r];a.seg.firstCol===t&&n.push(a.seg)}return n}function C(e,t,n,r,o){for(var a=e.length,i={},s=[],l=0;l<a;l++)s.push([]);for(l=0;l<a;l++)for(var c=0,d=0,u=n[l];d<u.length;d++){var f=u[d];o(f,c)?p(f):g(f),f.top!==f.bottom&&c++}function p(e){var t=e.seg,n=t.eventRange.instance.instanceId;if(!i[n]){i[n]=!0;for(var r=t.firstCol;r<=t.lastCol;r++)s[r].push(e)}}function g(n){var o=n.seg,a=o.eventRange.instance.instanceId;if(!t[a]){t[a]=!0;for(var i=o.firstCol;i<=o.lastCol;i++){var l=++e[i];if(r&&1===l){var c=s[i].pop();c&&g(c)}}}}}var S=function(e){function n(){var n=null!==e&&e.apply(this,arguments)||this;return n.cellElRefs=new t.RefMap,n.frameElRefs=new t.RefMap,n.fgElRefs=new t.RefMap,n.segHarnessRefs=new t.RefMap,n.rootElRef=t.createRef(),n.state={framePositions:null,maxContentHeight:null,segHeights:{}},n}return r(n,e),n.prototype.render=function(){var e=this,n=this.props,r=this.state,o=this.context,a=n.cells.length,i=s(n.businessHourSegs,a),l=s(n.bgEventSegs,a),c=s(this.getHighlightSegs(),a),u=s(this.getMirrorSegs(),a),f=E(n.cells,n.fgEventSegs,n.dayMaxEvents,n.dayMaxEventRows,r.segHeights,r.maxContentHeight,a,o.options.eventOrder),p=f.paddingBottoms,g=f.segsByFirstCol,h=f.segsByEachCol,v=f.segIsHidden,m=f.segTops,y=f.segMarginTops,R=f.moreCnts,C=f.moreTops,S=n.eventDrag&&n.eventDrag.affectedInstances||n.eventResize&&n.eventResize.affectedInstances||{};return t.createElement("tr",{ref:this.rootElRef},n.renderIntro&&n.renderIntro(),n.cells.map((function(r,o){var a=e.renderFgSegs(g[o],v,m,y,S,n.todayRange),s=e.renderFgSegs(u[o],{},m,{},{},n.todayRange,Boolean(n.eventDrag),Boolean(n.eventResize),!1);return t.createElement(d,{key:r.key,elRef:e.cellElRefs.createRef(r.key),innerElRef:e.frameElRefs.createRef(r.key),dateProfile:n.dateProfile,date:r.date,showDayNumber:n.showDayNumbers,showWeekNumber:n.showWeekNumbers&&0===o,forceDayTop:n.showWeekNumbers,todayRange:n.todayRange,extraHookProps:r.extraHookProps,extraDataAttrs:r.extraDataAttrs,extraClassNames:r.extraClassNames,moreCnt:R[o],buildMoreLinkText:n.buildMoreLinkText,onMoreClick:n.onMoreClick,segIsHidden:v,moreMarginTop:C[o],segsByEachCol:h[o],fgPaddingBottom:p[o],fgContentElRef:e.fgElRefs.createRef(r.key),fgContent:t.createElement(t.Fragment,null,t.createElement(t.Fragment,null,a),t.createElement(t.Fragment,null,s)),bgContent:t.createElement(t.Fragment,null,e.renderFillSegs(c[o],"highlight"),e.renderFillSegs(i[o],"non-business"),e.renderFillSegs(l[o],"bg-event"))})})))},n.prototype.componentDidMount=function(){this.updateSizing(!0)},n.prototype.componentDidUpdate=function(e,n){var r=this.props;this.updateSizing(!t.isPropsEqual(e,r))},n.prototype.getHighlightSegs=function(){var e=this.props;return e.eventDrag&&e.eventDrag.segs.length?e.eventDrag.segs:e.eventResize&&e.eventResize.segs.length?e.eventResize.segs:e.dateSelectionSegs},n.prototype.getMirrorSegs=function(){var e=this.props;return e.eventResize&&e.eventResize.segs.length?e.eventResize.segs:[]},n.prototype.renderFgSegs=function(e,n,r,a,i,s,l,c,d){var u=this.context,f=this.props.eventSelection,p=this.state.framePositions,g=1===this.props.cells.length,m=[];if(p)for(var E=0,R=e;E<R.length;E++){var C=R[E],S=C.eventRange.instance.instanceId,b=l||c||d,k=i[S],D=n[S]||k,w=n[S]||b||C.firstCol!==C.lastCol||!C.isStart||!C.isEnd,M=void 0,x=void 0,P=void 0,N=void 0;w?(x=r[S],u.isRtl?(N=0,P=p.lefts[C.lastCol]-p.lefts[C.firstCol]):(P=0,N=p.rights[C.firstCol]-p.rights[C.lastCol])):M=a[S],m.push(t.createElement("div",{className:"fc-daygrid-event-harness"+(w?" fc-daygrid-event-harness-abs":""),key:S,ref:b?null:this.segHarnessRefs.createRef(S+":"+C.firstCol),style:{visibility:D?"hidden":"",marginTop:M||"",top:x||"",left:P||"",right:N||""}},h(C)?t.createElement(v,o({seg:C,isDragging:l,isSelected:S===f,defaultDisplayEventEnd:g},t.getSegMeta(C,s))):t.createElement(y,o({seg:C,isDragging:l,isResizing:c,isDateSelecting:d,isSelected:S===f,defaultDisplayEventEnd:g},t.getSegMeta(C,s)))))}return m},n.prototype.renderFillSegs=function(e,n){var r=this.context.isRtl,a=this.props.todayRange,i=this.state.framePositions,s=[];if(i)for(var l=0,c=e;l<c.length;l++){var d=c[l],u=r?{right:0,left:i.lefts[d.lastCol]-i.lefts[d.firstCol]}:{left:0,right:i.rights[d.firstCol]-i.rights[d.lastCol]};s.push(t.createElement("div",{key:t.buildEventRangeKey(d.eventRange),className:"fc-daygrid-bg-harness",style:u},"bg-event"===n?t.createElement(t.BgEvent,o({seg:d},t.getSegMeta(d,a))):t.renderFill(n)))}return t.createElement.apply(void 0,function(){for(var e=0,t=0,n=arguments.length;t<n;t++)e+=arguments[t].length;var r=Array(e),o=0;for(t=0;t<n;t++)for(var a=arguments[t],i=0,s=a.length;i<s;i++,o++)r[o]=a[i];return r}([t.Fragment,{}],s))},n.prototype.updateSizing=function(e){var n=this.props,r=this.frameElRefs;if(null!==n.clientWidth){if(e){var o=n.cells.map((function(e){return r.currentMap[e.key]}));if(o.length){var a=this.rootElRef.current;this.setState({framePositions:new t.PositionCache(a,o,!0,!1)})}}var i=!0===n.dayMaxEvents||!0===n.dayMaxEventRows;this.setState({segHeights:this.computeSegHeights(),maxContentHeight:i?this.computeMaxContentHeight():null})}},n.prototype.computeSegHeights=function(){return t.mapHash(this.segHarnessRefs.currentMap,(function(e){return e.getBoundingClientRect().height}))},n.prototype.computeMaxContentHeight=function(){var e=this.props.cells[0].key,t=this.cellElRefs.currentMap[e],n=this.fgElRefs.currentMap[e];return t.getBoundingClientRect().bottom-n.getBoundingClientRect().top},n.prototype.getCellEls=function(){var e=this.cellElRefs.currentMap;return this.props.cells.map((function(t){return e[t.key]}))},n}(t.DateComponent);S.addStateEquality({segHeights:t.isPropsEqual});var b=function(e){function n(){var n=null!==e&&e.apply(this,arguments)||this;return n.repositioner=new t.DelayedRunner(n.updateSize.bind(n)),n.handleRootEl=function(e){n.rootEl=e,n.props.elRef&&t.setRef(n.props.elRef,e)},n.handleDocumentMousedown=function(e){var t=n.props.onClose;t&&!n.rootEl.contains(e.target)&&t()},n.handleDocumentScroll=function(){n.repositioner.request(10)},n.handleCloseClick=function(){var e=n.props.onClose;e&&e()},n}return r(n,e),n.prototype.render=function(){var e=this.context.theme,n=this.props,r=["fc-popover",e.getClass("popover")].concat(n.extraClassNames||[]);return t.createElement("div",o({className:r.join(" ")},n.extraAttrs,{ref:this.handleRootEl}),t.createElement("div",{className:"fc-popover-header "+e.getClass("popoverHeader")},t.createElement("span",{className:"fc-popover-title"},n.title),t.createElement("span",{className:"fc-popover-close "+e.getIconClass("close"),onClick:this.handleCloseClick})),t.createElement("div",{className:"fc-popover-body "+e.getClass("popoverContent")},n.children))},n.prototype.componentDidMount=function(){document.addEventListener("mousedown",this.handleDocumentMousedown),document.addEventListener("scroll",this.handleDocumentScroll),this.updateSize()},n.prototype.componentWillUnmount=function(){document.removeEventListener("mousedown",this.handleDocumentMousedown),document.removeEventListener("scroll",this.handleDocumentScroll)},n.prototype.updateSize=function(){var e=this.props,n=e.alignmentEl,r=e.topAlignmentEl,o=this.rootEl;if(o){var a,i=o.getBoundingClientRect(),s=n.getBoundingClientRect(),l=r?r.getBoundingClientRect().top:s.top;l=Math.min(l,window.innerHeight-i.height-10),l=Math.max(l,10),a=this.context.isRtl?s.right-i.width:s.left,a=Math.min(a,window.innerWidth-i.width-10),a=Math.max(a,10),t.applyStyle(o,{top:l,left:a})}},n}(t.BaseComponent),k=function(e){function n(){var t=null!==e&&e.apply(this,arguments)||this;return t.handlePopoverEl=function(e){t.popoverEl=e,e?t.context.registerInteractiveComponent(t,{el:e,useEventCenter:!1}):t.context.unregisterInteractiveComponent(t)},t}return r(n,e),n.prototype.render=function(){var e=this.context,n=e.options,r=e.dateEnv,a=this.props,i=a.date,s=a.hiddenInstances,l=a.todayRange,c=a.dateProfile,d=a.selectedInstanceId,u=r.format(i,n.dayPopoverFormat);return t.createElement(t.DayCellRoot,{date:i,dateProfile:c,todayRange:l,elRef:this.handlePopoverEl},(function(e,n,r){return t.createElement(b,{elRef:e,title:u,extraClassNames:["fc-more-popover"].concat(n),extraAttrs:r,onClose:a.onCloseClick,alignmentEl:a.alignmentEl,topAlignmentEl:a.topAlignmentEl},t.createElement(t.DayCellContent,{date:i,dateProfile:c,todayRange:l},(function(e,n){return n&&t.createElement("div",{className:"fc-more-popover-misc",ref:e},n)})),a.segs.map((function(e){var n=e.eventRange.instance.instanceId;return t.createElement("div",{className:"fc-daygrid-event-harness",key:n,style:{visibility:s[n]?"hidden":""}},h(e)?t.createElement(v,o({seg:e,isDragging:!1,isSelected:n===d,defaultDisplayEventEnd:!1},t.getSegMeta(e,l))):t.createElement(y,o({seg:e,isDragging:!1,isResizing:!1,isDateSelecting:!1,isSelected:n===d,defaultDisplayEventEnd:!1},t.getSegMeta(e,l))))})))}))},n.prototype.queryHit=function(e,n,r,o){var a=this.props.date;if(e<r&&n<o)return{component:this,dateSpan:{allDay:!0,range:{start:a,end:t.addDays(a,1)}},dayEl:this.popoverEl,rect:{left:0,top:0,right:r,bottom:o},layer:1}},n.prototype.isPopover=function(){return!0},n}(t.DateComponent),D=function(e){function n(){var n=null!==e&&e.apply(this,arguments)||this;return n.splitBusinessHourSegs=t.memoize(i),n.splitBgEventSegs=t.memoize(i),n.splitFgEventSegs=t.memoize(i),n.splitDateSelectionSegs=t.memoize(i),n.splitEventDrag=t.memoize(l),n.splitEventResize=t.memoize(l),n.buildBuildMoreLinkText=t.memoize(w),n.rowRefs=new t.RefMap,n.state={morePopoverState:null},n.handleRootEl=function(e){n.rootEl=e,t.setRef(n.props.elRef,e)},n.handleMoreLinkClick=function(e){var r=n.context,a=r.dateEnv,i=r.options.moreLinkClick;function s(e){var n=e.eventRange,o=n.def,i=n.instance,s=n.range;return{event:new t.EventApi(r,o,i),start:a.toDate(s.start),end:a.toDate(s.end),isStart:e.isStart,isEnd:e.isEnd}}"function"==typeof i&&(i=i({date:a.toDate(e.date),allDay:!0,allSegs:e.allSegs.map(s),hiddenSegs:e.hiddenSegs.map(s),jsEvent:e.ev,view:r.viewApi})),i&&"popover"!==i?"string"==typeof i&&r.calendarApi.zoomTo(e.date,i):n.setState({morePopoverState:o(o({},e),{currentFgEventSegs:n.props.fgEventSegs})})},n.handleMorePopoverClose=function(){n.setState({morePopoverState:null})},n}return r(n,e),n.prototype.render=function(){var e=this,n=this.props,r=n.dateProfile,o=n.dayMaxEventRows,a=n.dayMaxEvents,i=n.expandRows,s=this.state.morePopoverState,l=n.cells.length,c=this.splitBusinessHourSegs(n.businessHourSegs,l),d=this.splitBgEventSegs(n.bgEventSegs,l),u=this.splitFgEventSegs(n.fgEventSegs,l),f=this.splitDateSelectionSegs(n.dateSelectionSegs,l),p=this.splitEventDrag(n.eventDrag,l),g=this.splitEventResize(n.eventResize,l),h=this.buildBuildMoreLinkText(this.context.options.moreLinkText),v=!0===a||!0===o;v&&!i&&(v=!1,o=null,a=null);var m=["fc-daygrid-body",v?"fc-daygrid-body-balanced":"fc-daygrid-body-unbalanced",i?"":"fc-daygrid-body-natural"];return t.createElement("div",{className:m.join(" "),ref:this.handleRootEl,style:{width:n.clientWidth,minWidth:n.tableMinWidth}},t.createElement(t.NowTimer,{unit:"day"},(function(v,m){return t.createElement(t.Fragment,null,t.createElement("table",{className:"fc-scrollgrid-sync-table",style:{width:n.clientWidth,minWidth:n.tableMinWidth,height:i?n.clientHeight:""}},n.colGroupNode,t.createElement("tbody",null,n.cells.map((function(i,s){return t.createElement(S,{ref:e.rowRefs.createRef(s),key:i.length?i[0].date.toISOString():s,showDayNumbers:l>1,showWeekNumbers:n.showWeekNumbers,todayRange:m,dateProfile:r,cells:i,renderIntro:n.renderRowIntro,businessHourSegs:c[s],eventSelection:n.eventSelection,bgEventSegs:d[s].filter(M),fgEventSegs:u[s],dateSelectionSegs:f[s],eventDrag:p[s],eventResize:g[s],dayMaxEvents:a,dayMaxEventRows:o,clientWidth:n.clientWidth,clientHeight:n.clientHeight,buildMoreLinkText:h,onMoreClick:e.handleMoreLinkClick})})))),!n.forPrint&&s&&s.currentFgEventSegs===n.fgEventSegs&&t.createElement(k,{date:s.date,dateProfile:r,segs:s.allSegs,alignmentEl:s.dayEl,topAlignmentEl:1===l?n.headerAlignElRef.current:null,onCloseClick:e.handleMorePopoverClose,selectedInstanceId:n.eventSelection,hiddenInstances:(n.eventDrag?n.eventDrag.affectedInstances:null)||(n.eventResize?n.eventResize.affectedInstances:null)||{},todayRange:m}))})))},n.prototype.prepareHits=function(){this.rowPositions=new t.PositionCache(this.rootEl,this.rowRefs.collect().map((function(e){return e.getCellEls()[0]})),!1,!0),this.colPositions=new t.PositionCache(this.rootEl,this.rowRefs.currentMap[0].getCellEls(),!0,!1)},n.prototype.positionToHit=function(e,t){var n=this.colPositions,r=this.rowPositions,o=n.leftToIndex(e),a=r.topToIndex(t);if(null!=a&&null!=o)return{row:a,col:o,dateSpan:{range:this.getCellRange(a,o),allDay:!0},dayEl:this.getCellEl(a,o),relativeRect:{left:n.lefts[o],right:n.rights[o],top:r.tops[a],bottom:r.bottoms[a]}}},n.prototype.getCellEl=function(e,t){return this.rowRefs.currentMap[e].getCellEls()[t]},n.prototype.getCellRange=function(e,n){var r=this.props.cells[e][n].date;return{start:r,end:t.addDays(r,1)}},n}(t.DateComponent);function w(e){return"function"==typeof e?e:function(t){return"+"+t+" "+e}}function M(e){return e.eventRange.def.allDay}var x=function(e){function n(){var n=null!==e&&e.apply(this,arguments)||this;return n.slicer=new P,n.tableRef=t.createRef(),n.handleRootEl=function(e){e?n.context.registerInteractiveComponent(n,{el:e}):n.context.unregisterInteractiveComponent(n)},n}return r(n,e),n.prototype.render=function(){var e=this.props,n=this.context;return t.createElement(D,o({ref:this.tableRef,elRef:this.handleRootEl},this.slicer.sliceProps(e,e.dateProfile,e.nextDayThreshold,n,e.dayTableModel),{dateProfile:e.dateProfile,cells:e.dayTableModel.cells,colGroupNode:e.colGroupNode,tableMinWidth:e.tableMinWidth,renderRowIntro:e.renderRowIntro,dayMaxEvents:e.dayMaxEvents,dayMaxEventRows:e.dayMaxEventRows,showWeekNumbers:e.showWeekNumbers,expandRows:e.expandRows,headerAlignElRef:e.headerAlignElRef,clientWidth:e.clientWidth,clientHeight:e.clientHeight,forPrint:e.forPrint}))},n.prototype.prepareHits=function(){this.tableRef.current.prepareHits()},n.prototype.queryHit=function(e,t){var n=this.tableRef.current.positionToHit(e,t);if(n)return{component:this,dateSpan:n.dateSpan,dayEl:n.dayEl,rect:{left:n.relativeRect.left,right:n.relativeRect.right,top:n.relativeRect.top,bottom:n.relativeRect.bottom},layer:0}},n}(t.DateComponent),P=function(e){function t(){var t=null!==e&&e.apply(this,arguments)||this;return t.forceDayIfListItem=!0,t}return r(t,e),t.prototype.sliceRange=function(e,t){return t.sliceRange(e)},t}(t.Slicer),N=function(e){function n(){var n=null!==e&&e.apply(this,arguments)||this;return n.buildDayTableModel=t.memoize(H),n.headerRef=t.createRef(),n.tableRef=t.createRef(),n}return r(n,e),n.prototype.render=function(){var e=this,n=this.context,r=n.options,o=n.dateProfileGenerator,a=this.props,i=this.buildDayTableModel(a.dateProfile,o),s=r.dayHeaders&&t.createElement(t.DayHeader,{ref:this.headerRef,dateProfile:a.dateProfile,dates:i.headerDates,datesRepDistinctDays:1===i.rowCnt}),l=function(n){return t.createElement(x,{ref:e.tableRef,dateProfile:a.dateProfile,dayTableModel:i,businessHours:a.businessHours,dateSelection:a.dateSelection,eventStore:a.eventStore,eventUiBases:a.eventUiBases,eventSelection:a.eventSelection,eventDrag:a.eventDrag,eventResize:a.eventResize,nextDayThreshold:r.nextDayThreshold,colGroupNode:n.tableColGroupNode,tableMinWidth:n.tableMinWidth,dayMaxEvents:r.dayMaxEvents,dayMaxEventRows:r.dayMaxEventRows,showWeekNumbers:r.weekNumbers,expandRows:!a.isHeightAuto,headerAlignElRef:e.headerElRef,clientWidth:n.clientWidth,clientHeight:n.clientHeight,forPrint:a.forPrint})};return r.dayMinWidth?this.renderHScrollLayout(s,l,i.colCnt,r.dayMinWidth):this.renderSimpleLayout(s,l)},n}(a);function H(e,n){var r=new t.DaySeriesModel(e.renderRange,n);return new t.DayTableModel(r,/year|month|week/.test(e.currentRangeUnit))}var T=function(e){function n(){return null!==e&&e.apply(this,arguments)||this}return r(n,e),n.prototype.buildRenderRange=function(n,r,o){var a,i=this.props.dateEnv,s=e.prototype.buildRenderRange.call(this,n,r,o),l=s.start,c=s.end;if(/^(year|month)$/.test(r)&&(l=i.startOfWeek(l),(a=i.startOfWeek(c)).valueOf()!==c.valueOf()&&(c=t.addWeeks(a,1))),this.props.monthMode&&this.props.fixedWeekCount){var d=Math.ceil(t.diffWeeks(l,c));c=t.addWeeks(c,6-d)}return{start:l,end:c}},n}(t.DateProfileGenerator),I={moreLinkClick:t.identity,moreLinkClassNames:t.identity,moreLinkContent:t.identity,moreLinkDidMount:t.identity,moreLinkWillUnmount:t.identity},W=t.createPlugin({initialView:"dayGridMonth",optionRefiners:I,views:{dayGrid:{component:N,dateProfileGeneratorClass:T},dayGridDay:{type:"dayGrid",duration:{days:1}},dayGridWeek:{type:"dayGrid",duration:{weeks:1}},dayGridMonth:{type:"dayGrid",duration:{months:1},monthMode:!0,fixedWeekCount:!0}}});return t.globalPlugins.push(W),e.DayGridView=N,e.DayTable=x,e.DayTableSlicer=P,e.Table=D,e.TableView=a,e.buildDayTableModel=H,e.default=W,e}({},FullCalendar);
