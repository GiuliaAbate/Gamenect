!function(){var e={184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function l(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var r=typeof n;if("string"===r||"number"===r)e.push(n);else if(Array.isArray(n)){if(n.length){var c=l.apply(null,n);c&&e.push(c)}}else if("object"===r){if(n.toString!==Object.prototype.toString&&!n.toString.toString().includes("[native code]")){e.push(n.toString());continue}for(var a in n)o.call(n,a)&&n[a]&&e.push(a)}}}return e.join(" ")}e.exports?(l.default=l,e.exports=l):void 0===(n=function(){return l}.apply(t,[]))||(e.exports=n)}()}},t={};function n(o){var l=t[o];if(void 0!==l)return l.exports;var r=t[o]={exports:{}};return e[o](r,r.exports,n),r.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})};var o={};!function(){"use strict";n.r(o),n.d(o,{ConfirmDialogue:function(){return u},ControlledTabPanel:function(){return s},DeviceToggle:function(){return d},EntitySelectControl:function(){return _},FieldPanel:function(){return S},FieldRow:function(){return C},FreeFormEditControl:function(){return $},ListTable:function(){return U},RadioButtonControl:function(){return K},SearchableMulticheckControl:function(){return Q},SmartTokenControl:function(){return w},TextHighlight:function(){return q},URLControl:function(){return z},useControlledState:function(){return H}});var e=window.React,t=n(184),l=n.n(t),r=window.wp.components,c=window.wp.compose,a=({tabId:t,onClick:n,children:o,selected:l,...c})=>(0,e.createElement)(r.Button,{role:"tab",tabIndex:l?void 0:-1,"aria-selected":l,id:t,onClick:n,...c},o),s=(0,c.withInstanceId)((({instanceId:t,orientation:n="horizontal",activeClass:o="is-active",tabsClass:c="tabs",tabClass:s="tab",className:i,tabs:u,selected:m,onSelect:d,children:p})=>{var g;const h=u.find((e=>m===e.name))||u[0],v=`${t}-${null!==(g=h?.name)&&void 0!==g?g:"none"}`;return(0,e.createElement)("div",{className:l()(i,"cc-"+n+"-tabs")},(0,e.createElement)(r.NavigableMenu,{role:"tablist",orientation:n,onNavigate:(e,t)=>{t.click()},className:l()([c,"components-tab-panel__tabs"])},u.map((n=>{var r,c;return(0,e.createElement)(a,{className:l()(s,"components-tab-panel__tabs-item","components-tab-panel__tab",n.className,{[o]:n.name===h.name}),tabId:`${t}-${n.name}`,"aria-controls":`${t}-${n.name}-view`,selected:n.name===h.name,key:n.name,onClick:()=>{return e=n.name,void d?.(e);var e},href:null!==(r=n?.href)&&void 0!==r?r:void 0,target:null!==(c=n?.target)&&void 0!==c?c:void 0},n.title)}))),h&&(0,e.createElement)("div",{key:v,"aria-labelledby":v,role:"tabpanel",id:`${v}-view`,className:"components-tab-panel__tab-content",tabIndex:0},p&&p(h)))})),i=window.wp.i18n,u=({message:t,callback:n,onClose:o,isDestructive:l=!1})=>t&&t.length&&n?(0,e.createElement)(r.Modal,{title:(0,i.__)("Confirm Action","content-control"),onRequestClose:o},(0,e.createElement)("p",null,t),(0,e.createElement)(r.Flex,{justify:"right"},(0,e.createElement)(r.Button,{text:(0,i.__)("Cancel","content-control"),onClick:o}),(0,e.createElement)(r.Button,{variant:"primary",text:(0,i.__)("Confirm","content-control"),isDestructive:l,onClick:()=>{n(),o()}}))):null,m=window.contentControl.utils,d=({label:t,icon:n,isVisible:o,onChange:c=m.noop})=>{const a=o?/* translators: 1. Device type. */
(0,i._x)("Show on %1$s","Device toggle option","content-control"):/* translators: 1. Device type. */
(0,i._x)("Hide on %1$s","Device toggle option","content-control"),s=o?"visibility":"hidden",u=()=>c(!o);return(0,e.createElement)("div",{className:l()(["cc__component-device-toggle",o&&"is-checked"])},(0,e.createElement)("h3",{className:"cc__component-device-toggle__label"},(0,e.createElement)(r.Icon,{icon:n}),t),(0,e.createElement)("div",{className:"cc__component-device-toggle__control"},(0,e.createElement)(r.Tooltip,{text:(0,i.sprintf)(a,t)},(0,e.createElement)("span",null,(0,e.createElement)(r.Icon,{className:"cc__component-device-toggle__control-icon",onClick:u,icon:s}))),(0,e.createElement)(r.Tooltip,{text:(0,i.sprintf)(a,t)},(0,e.createElement)("span",null,(0,e.createElement)(r.ToggleControl,{className:"cc__component-device-toggle__control-input",checked:o,onChange:u,hideLabelFromVision:!0,"aria-label":a,label:(0,i.sprintf)(/* translators: 1. Device type. */
(0,i._x)("Show on %1$s","Device toggle option","content-control"),t)})))))},p=window.wp.data,g=window.wp.element,h=window.wp.coreData,v=window.wp.primitives,f=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"}));const E={container:"component-smart-token-control",popover:"component-smart-token-control__suggestions-popover",inputContainer:"component-smart-token-control__input",tokens:"component-smart-token-control__tokens",token:"component-smart-token-control__token",tokenLabel:"component-smart-token-control__token-label",tokenRemove:"component-smart-token-control__token-remove",textInput:"component-smart-token-control__text-input",toggleSuggestions:"component-smart-token-control__toggle",suggestions:"component-smart-token-control__suggestions",suggestion:"component-smart-token-control__suggestion"},b=({id:t,value:n,onChange:o,label:a,placeholder:s=(0,i.__)("Enter a value","content-control"),className:u,tokenOnComma:d=!1,classes:p=E,renderToken:h=(t=>(0,e.createElement)(e.Fragment,null,"string"==typeof t?t:t.item)),renderSuggestion:v=(t=>(0,e.createElement)(e.Fragment,null,t)),onInputChange:w=m.noop,saveTransform:_=(e=>e),closeOnSelect:S=!1,hideLabelFromVision:C=!1,extraKeyboardShortcuts:y={},multiple:k=!1,suggestions:x,messages:N={searchTokens:(0,i.__)("Search","content-control"),noSuggestions:(0,i.__)("No suggestions","content-control"),removeToken:(0,i.__)("Remove token","content-control")}},R)=>{const $={...E,...p},I=(0,c.useInstanceId)(b),F=(0,g.useRef)(null),B=(0,g.useRef)(null),T=(0,g.useRef)(null),[L,O]=(0,g.useState)({inputText:"",isFocused:!1,selectedSuggestion:-1,popoverOpen:!1,refocus:!1}),{inputText:D,isFocused:P,selectedSuggestion:M,popoverOpen:z}=L;function A(e){return"object"==typeof e?e.value:e}function V(e){return n.some((t=>A(e)===A(t)))}function H(e){!function(e){const t=[...new Set(e.map(_).filter(Boolean).filter((e=>!V(e))))];t.length>0&&o([...n,...t])}([e]),O({...L,inputText:"",popoverOpen:!S&&z})}const j=e=>O({...L,selectedSuggestion:e}),U=x.length,q=M>U?0:M;(0,g.useEffect)((()=>{setTimeout((()=>{T.current&&T.current.scrollIntoView()}),25)}),[M,z]),(0,g.useEffect)((()=>{L.refocus&&(O({...L,refocus:!1}),B.current?.focus())}),[L,L.refocus]);const G={up:e=>{e.preventDefault(),O({...L,popoverOpen:0===D.length&&!z||z,selectedSuggestion:(0,m.clamp)(q-1>=0?q-1:U,0,U)})},down:e=>{e.preventDefault(),O({...L,popoverOpen:0===D.length&&!z||z,selectedSuggestion:(0,m.clamp)(q+1<=U?q+1:0,0,U)})},"alt+down":()=>O({...L,popoverOpen:!0}),enter:()=>{if(-1===M)return O({...L,popoverOpen:!1});H(x[q])},escape:e=>{e.preventDefault(),e.stopPropagation(),O({...L,selectedSuggestion:-1,popoverOpen:!1})},",":e=>{d&&(e.preventDefault(),0!==D.length&&H(D))},...y};return(0,e.createElement)(r.KeyboardShortcuts,{shortcuts:G},(0,e.createElement)("div",{id:t?`${t}-wrapper`:`component-smart-token-control-${I}-wrapper`,className:l()([$.container,P&&"is-focused",u]),ref:e=>{F.current=e,R&&"object"==typeof R&&(R.current=e)},onBlur:e=>{e.relatedTarget&&e.relatedTarget.classList.contains($.popover)||O({...L,isFocused:!1,popoverOpen:!1})}},(0,e.createElement)(r.BaseControl,{id:t||`component-smart-token-control-${I}`,label:a,hideLabelFromVision:C},(0,e.createElement)("div",{className:l()([$.inputContainer,!k&&n.length>0&&"input-disabled"])},n.length>0&&(0,e.createElement)("div",{className:$.tokens},n.map((t=>(0,e.createElement)("div",{className:$.token,key:A(t)},(0,e.createElement)("div",{className:$.tokenLabel},h(t)),(0,e.createElement)(r.Button,{className:$.tokenRemove,label:N.removeToken,icon:f,onClick:()=>function(e){O({...L,refocus:!0}),o(n.filter((t=>A(t)!==A(e))))}(t)}))))),(0,e.createElement)("input",{id:t||`component-smart-token-control-${I}`,type:"text",className:l()([$.textInput]),placeholder:s,disabled:!k&&n.length>0,ref:B,value:null!=D?D:"",onChange:e=>{return t=e.target.value,O({...L,inputText:t,popoverOpen:t.length>=1}),void w(t);var t},autoComplete:"off","aria-autocomplete":"list","aria-controls":t?`${t}-listbox`:`${I}-listbox`,"aria-activedescendant":`sug-${q}`,onFocus:()=>{O({...L,isFocused:!0,popoverOpen:D.length>=1})},onClick:()=>{z||O({...L,popoverOpen:x.length>0})},onBlur:e=>{const t=e.relatedTarget;t&&t.classList.contains($.popover)||O({...L,isFocused:!1,popoverOpen:!1})}}))),z&&(0,e.createElement)(r.Popover,{focusOnMount:!1,onClose:()=>j(-1),position:"bottom right",anchor:B.current,className:$.popover},(0,e.createElement)("div",{className:$.suggestions,style:{width:B.current?.clientWidth}},x.length?x.map(((t,n)=>(0,e.createElement)("div",{key:n,id:`sug-${n}`,className:l()([$.suggestion,n===q&&"is-currently-highlighted",V(t)&&"is-selected"]),ref:n===q?T:void 0,onFocus:()=>{j(n)},onMouseDown:e=>{e.preventDefault(),H(x[n])},role:"option",tabIndex:n,"aria-selected":n===q},v(t)))):(0,e.createElement)("div",null,N.noSuggestions)))))};var w=(0,g.forwardRef)(b),_=({id:t,label:n,value:o,onChange:l,placeholder:r,entityKind:a="postType",entityType:s="post",multiple:u=!1,...m})=>{const[d,v]=(0,g.useState)(""),f=(0,c.useDebounce)((e=>{v(e)}),300),{prefill:E=[]}=(0,p.useSelect)((e=>({prefill:o?e(h.store).getEntityRecords(a,s,{context:"view",include:o,per_page:-1}):[]})),[o,a,s]),{suggestions:b=[],isSearching:_=!1}=(0,p.useSelect)((e=>({suggestions:e(h.store).getEntityRecords(a,s,{context:"view",search:d,per_page:-1}),isSearching:e("core/data").isResolving("core","getEntityRecords",[a,s,{context:"view",search:d,per_page:-1}])})),[a,s,d]),S=e=>b&&b.find((t=>t.id.toString()===e.toString()))||E&&E.find((t=>t.id.toString()===e.toString())),C=o?(Array.isArray(o)?o:[o]).map((e=>e.toString())):[],y=e=>"object"==typeof e?e.value:e;return(0,e.createElement)("div",{className:"cc-object-search-field"},(0,e.createElement)(w,{id:t,label:n||(0,i.sprintf)(
// translators: %s: entity type.
(0,i.__)("%s(s)","content-control"),s.replace(/_/g," ").charAt(0).toUpperCase()+s.replace(/_/g," ").slice(1)),multiple:u,placeholder:r||(0,i.sprintf)(
// translators: %s: entity type.
(0,i.__)("Select %s(s)","content-control"),s.replace(/_/g," ").toLowerCase()),...m,tokenOnComma:!0,value:C,onInputChange:f,onChange:e=>{const t=e.map((e=>parseInt(y(e),10))).filter((e=>!isNaN(e)));l(u?t:t[0])},renderToken:e=>{var t;const n=S(y(e));return n?"postType"===a?null!==(t=n.title.rendered)&&void 0!==t?t:n.title.raw:n.name:y(e)},renderSuggestion:t=>{var n;const o=S(t);return o?(0,e.createElement)(e.Fragment,null,"postType"===a?null!==(n=o.title.rendered)&&void 0!==n?n:o.title.raw:o.name):t},suggestions:b?b.map((e=>{var t;return null!==(t=e?.id.toString())&&void 0!==t&&t})):[],messages:_?{noSuggestions:(0,i.__)("Searching…","content-control")}:void 0}))},S=({title:t,className:n,children:o})=>(0,e.createElement)(r.Panel,{header:t,className:l()(["components-field-panel",n])},(0,e.createElement)(r.PanelBody,{opened:!0},o)),C=({id:t,label:n,description:o,className:r,children:c})=>(0,e.createElement)("div",{className:l()(["components-field-row",r])},(0,e.createElement)("div",{className:"components-base-control"},(0,e.createElement)("label",{htmlFor:t,className:"components-truncate components-text components-input-control__label"},n),(0,e.createElement)("p",{className:"components-base-control__help"},o)),(0,e.createElement)("div",{className:"components-base-control__field"},c)),y=window.wp.keycodes;const{wp:k,tinymce:x,wpEditorL10n:N={tinymce:{baseURL:"",suffix:"",settings:{}}}}=window,R=t=>{const n=(0,c.useInstanceId)(R),{label:o,value:a,onChange:s=m.noop,className:u,minHeight:d=100}=t,p=(0,g.useRef)(!1);return(0,g.useEffect)((()=>{if(!p.current)return;const e=x.get(`editor-${n}`),t=e?.getContent();t!==a&&e.setContent(a||"")}),[a,n]),(0,g.useEffect)((()=>{const{baseURL:e,suffix:t}=N.tinymce;function o(e){let t;a&&e.on("loadContent",(()=>e.setContent(a))),e.on("blur",(()=>{t=e.selection.getBookmark(2,!0);const n=document.querySelector(".interface-interface-skeleton__content"),o=n?.scrollTop;return s(e.getContent()),e.once("focus",(()=>{t&&(e.selection.moveToBookmark(t),n&&n?.scrollTop!==o&&(n.scrollTop=o||0))})),!1})),e.on("mousedown touchstart",(()=>{t=null}));const n=(0,c.debounce)((()=>{const t=e.getContent();t!==e._lastChange&&(e._lastChange=t,s(t))}),250);e.on("Paste Change input Undo Redo",n),e.on("remove",n.cancel),e.on("keydown",(e=>{y.isKeyboardEvent.primary(e,"z")&&e.stopPropagation();const{altKey:t}=e;t&&e.keyCode===y.F10&&e.stopPropagation()})),e.on("init",(()=>{const t=e.getBody();t.ownerDocument.activeElement===t&&(t.blur(),e.focus())}))}function l(){const{settings:e}=N.tinymce;k.oldEditor.initialize(`editor-${n}`,{tinymce:{...e,inline:!0,content_css:!1,fixed_toolbar_container:`#toolbar-${n}`,setup:o}})}function r(){"complete"===document.readyState&&l()}return p.current=!0,x.EditorManager.overrideDefaults({base_url:e,suffix:t}),"complete"===document.readyState?l():document.addEventListener("readystatechange",r),()=>{document.removeEventListener("readystatechange",r),k.oldEditor.remove(`editor-${n}`)}}),[]),(0,e.createElement)(r.BaseControl,{id:`freeform-edit-control-${n}`,label:o,className:l()(["component-freeform-edit-control",u])},(0,e.createElement)("div",{key:"toolbar",id:`toolbar-${n}`,className:"block-library-classic__toolbar",onClick:function(){const e=x.get(`editor-${n}`);e&&e.focus()},onKeyDown:function(e){e.stopPropagation(),e.nativeEvent.stopImmediatePropagation()},"data-placeholder":(0,i.__)("Click here to edit this text.","content-control")}),(0,e.createElement)("div",{key:"editor",id:`editor-${n}`,style:{minHeight:d},className:"wp-block-freeform block-library-rich-text__tinymce"}))};var $=R,I=window.lodash,F=window.contentControl.coreData,B=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"M12 3.3c-4.8 0-8.8 3.9-8.8 8.8 0 4.8 3.9 8.8 8.8 8.8 4.8 0 8.8-3.9 8.8-8.8s-4-8.8-8.8-8.8zm6.5 5.5h-2.6C15.4 7.3 14.8 6 14 5c2 .6 3.6 2 4.5 3.8zm.7 3.2c0 .6-.1 1.2-.2 1.8h-2.9c.1-.6.1-1.2.1-1.8s-.1-1.2-.1-1.8H19c.2.6.2 1.2.2 1.8zM12 18.7c-1-.7-1.8-1.9-2.3-3.5h4.6c-.5 1.6-1.3 2.9-2.3 3.5zm-2.6-4.9c-.1-.6-.1-1.1-.1-1.8 0-.6.1-1.2.1-1.8h5.2c.1.6.1 1.1.1 1.8s-.1 1.2-.1 1.8H9.4zM4.8 12c0-.6.1-1.2.2-1.8h2.9c-.1.6-.1 1.2-.1 1.8 0 .6.1 1.2.1 1.8H5c-.2-.6-.2-1.2-.2-1.8zM12 5.3c1 .7 1.8 1.9 2.3 3.5H9.7c.5-1.6 1.3-2.9 2.3-3.5zM10 5c-.8 1-1.4 2.3-1.8 3.8H5.5C6.4 7 8 5.6 10 5zM5.5 15.3h2.6c.4 1.5 1 2.8 1.8 3.7-1.8-.6-3.5-2-4.4-3.7zM14 19c.8-1 1.4-2.2 1.8-3.7h2.6C17.6 17 16 18.4 14 19z"})),T=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"m19 7-3-3-8.5 8.5-1 4 4-1L19 7Zm-7 11.5H5V20h7v-1.5Z"})),L=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"M10 17.389H8.444A5.194 5.194 0 1 1 8.444 7H10v1.5H8.444a3.694 3.694 0 0 0 0 7.389H10v1.5ZM14 7h1.556a5.194 5.194 0 0 1 0 10.39H14v-1.5h1.556a3.694 3.694 0 0 0 0-7.39H14V7Zm-4.5 6h5v-1.5h-5V13Z"})),O=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"-2 -2 24 24"},(0,e.createElement)(v.Path,{d:"M6.734 16.106l2.176-2.38-1.093-1.028-3.846 4.158 3.846 4.157 1.093-1.027-2.176-2.38h2.811c1.125 0 2.25.03 3.374 0 1.428-.001 3.362-.25 4.963-1.277 1.66-1.065 2.868-2.906 2.868-5.859 0-2.479-1.327-4.896-3.65-5.93-1.82-.813-3.044-.8-4.806-.788l-.567.002v1.5c.184 0 .368 0 .553-.002 1.82-.007 2.704-.014 4.21.657 1.854.827 2.76 2.657 2.76 4.561 0 2.472-.973 3.824-2.178 4.596-1.258.807-2.864 1.04-4.163 1.04h-.02c-1.115.03-2.229 0-3.344 0H6.734z"})),D=(0,g.forwardRef)((({icon:t,title:n,info:o,type:c,className:a,isSelected:s,onFocus:i=m.noop,onSelect:u=m.noop,...d},p)=>(0,e.createElement)(r.Button,{type:"button",className:l()(["suggestion",s&&"is-selected",a]),ref:p,onClick:u,onFocus:i,onMouseOver:i,"aria-selected":s,role:"option",tabIndex:-1,...d},t&&(0,e.createElement)(r.Icon,{icon:t,className:"suggestion-item-icon"}),(0,e.createElement)("span",{className:"suggestion-item-header"},(0,e.createElement)("span",{className:"suggestion-item-title"},n),o&&(0,e.createElement)("span",{"aria-hidden":"true",className:"suggestion-item-info"},o)),c&&(0,e.createElement)("span",{className:"suggestion-item-type"},c))));const P={id:-1,title:"",url:"",type:(0,i.__)("URL","content-control")},M=({id:t,label:n,value:o,onChange:a=(()=>{}),className:s=""},u)=>{var m,d;const h=(0,c.useInstanceId)(M),v=(0,g.useRef)(null),f=(0,g.useRef)(null),E=(0,g.useRef)(null),b=(0,g.useRef)(null),w=(0,g.useRef)(null),_=(0,g.useRef)([]);(0,g.useImperativeHandle)(u,(()=>E.current),[E]);const S="string"==typeof o?{...P,url:o}:null!=o?o:P,C={value:S,query:null!==(m=S.url)&&void 0!==m?m:"",isEditing:!1,isFocused:!1,selected:-1,showSuggestions:!1},[y,k]=(0,g.useState)(C),{value:x,query:N,isFocused:R,isEditing:$,selected:z,showSuggestions:A}=y,V=t||`url-input-control-${h}`,H=`url-input-control-suggestions-${h}`,j=`url-input-${h}-sug-`,{unfilteredSuggestions:U,isFetchingSuggestions:q}=(0,p.useSelect)((e=>({unfilteredSuggestions:e(F.urlSearchStore).getSuggestions(),isFetchingSuggestions:e(F.urlSearchStore).isDispatching("updateSuggestions")})),[]),{updateSuggestions:G}=(0,p.useDispatch)(F.urlSearchStore),K=(0,I.debounce)(G,200,{leading:!0}),Z=e=>k({...y,selected:e}),W=e=>{const t={...y,value:{...x,...e},query:"",isEditing:!1,isFocused:!0,selected:-1,showSuggestions:!1};k(t)};(0,g.useEffect)((()=>{S.url!==x.url&&a(x)}),[x,S.url,a]),(0,g.useEffect)((()=>{R&&($?E.current?.focus():w.current?.focus())}),[$,R]);const J=(0,g.useMemo)((()=>U.filter(((e,t)=>U.findIndex((t=>e.id===t.id))===t))),[U]).slice(0,10),Q=J.length,X=z>Q?0:z,Y={up:()=>k({...y,showSuggestions:0===N.length&&!A||A,selected:(0,I.clamp)(X-1>=0?X-1:Q,0,Q)}),down:()=>{k({...y,showSuggestions:0===N.length&&!A||A,selected:(0,I.clamp)(X+1<=Q?X+1:0,0,Q)})},"alt+down":()=>k({...y,showSuggestions:!0}),enter:e=>{e.preventDefault(),A&&X>-1&&X!==Q?W(J[X]):x.url===N?k({...y,isEditing:!1,query:"",showSuggestions:!1,selected:-1}):W({title:(0,i.__)("Custom URL","content-control"),type:"URL",url:N})},escape:e=>{e.preventDefault(),e.stopPropagation(),k({...y,selected:-1,showSuggestions:!1})}};return(0,e.createElement)(r.BaseControl,{id:V,label:n,className:l()(["components-url-control",R&&"is-focused",s])},(0,e.createElement)("div",{ref:v,onFocus:()=>{k({...y,isFocused:!0,showSuggestions:N.length>=1})},onBlur:e=>{if(!v.current?.contains(e.relatedTarget)&&!b.current?.contains(e.relatedTarget)){const e={...y,selected:-1,isFocused:!1,showSuggestions:!1};$&&(e.isEditing=!1,e.value=z>-1?J[z]:{title:(0,i.__)("Custom URL"),type:"URL",url:N}),k(e)}}},!$&&S.url.length>0?(0,e.createElement)("div",{className:"suggestion"},(0,e.createElement)(r.Icon,{icon:B,className:"suggestion-item-icon"}),(0,e.createElement)("span",{className:"suggestion-item-header"},(0,e.createElement)("span",{className:"suggestion-item-title"},(0,e.createElement)(e.Fragment,null,null!==(d=x?.title)&&void 0!==d?d:x?.url)),(0,e.createElement)("span",{"aria-hidden":"true",className:"suggestion-item-info"},x.url)),(0,e.createElement)(r.Button,{"aria-label":(0,i.__)("Edit","content-control"),icon:T,onClick:()=>{k({...y,isEditing:!0,isFocused:!0,query:S.url})},ref:w})):(0,e.createElement)(r.KeyboardShortcuts,{shortcuts:Y},(0,e.createElement)("div",{className:l()(["url-control-wrapper"]),ref:f},(0,e.createElement)("div",{className:"url-control"},(0,e.createElement)(r.Icon,{icon:L,className:"url-control__input-icon"}),(0,e.createElement)("input",{id:V,className:"url-control__input",ref:E,type:"text",role:"combobox",placeholder:(0,i.__)("Search or type url","content-control"),value:N,onChange:e=>{return t=e.target.value,k({...y,query:t,showSuggestions:t.length>=1}),void K(t.trim(),{type:["post","term"]});var t},autoComplete:"off","aria-autocomplete":"list","aria-controls":H,"aria-expanded":A,"aria-activedescendant":X>=0?`${j}-${X}`:void 0,"aria-label":n?void 0:(0,i.__)("URL")}),(0,e.createElement)("div",{className:"url-control__actions"},q&&(0,e.createElement)(r.Spinner,null),(0,e.createElement)(r.Button,{icon:O,iconSize:30,onClick:()=>W({title:(0,i.__)("Custom URL","content-control"),type:"URL",url:N})}))),A&&J.length>0&&(0,e.createElement)(r.Popover,{ref:b,focusOnMount:!1,onClose:()=>Z(-1),position:"bottom right",anchor:f.current,className:"suggestions-popover"},(0,e.createElement)("div",{className:"suggestions",id:H,role:"listbox"},J.map(((t,n)=>(0,e.createElement)(D,{key:t.id,id:`${j}-${n}`,title:t.title,info:t.url,type:t.type,isSelected:n===X,onSelect:()=>W(t),onFocus:()=>Z(n),ref:e=>{_.current[n]=e}}))),N.length>0&&(0,e.createElement)(D,{key:"use-current-input-text",id:`${j}-${Q}`,icon:B,title:N,info:(0,i.__)("Press ENTER to add this link","content-control"),type:(0,i.__)("URL","content-control"),className:"is-url",isSelected:Q===X,onSelect:()=>W({title:(0,i.__)("Custom URL","content-control"),type:"URL",url:N}),onFocus:()=>{Z(Q)},ref:e=>{_.current[Q]=e}})))))))};var z=(0,g.forwardRef)(M),A=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"M12 3.9 6.5 9.5l1 1 3.8-3.7V20h1.5V6.8l3.7 3.7 1-1z"})),V=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"m16.5 13.5-3.7 3.7V4h-1.5v13.2l-3.8-3.7-1 1 5.5 5.6 5.5-5.6z"}));function H(e,t,n){const[o,l]=(0,g.useState)(e||t),r=(0,g.useRef)(void 0!==e),c=r.current,a=void 0!==e,s=(0,g.useRef)(o);c!==a&&console.warn(`WARN: A component changed from ${c?"controlled":"uncontrolled"} to ${a?"controlled":"uncontrolled"}.`),r.current=a;const i=(0,g.useCallback)(((e,...t)=>{const o=(e,...t)=>{n&&(Object.is(s.current,e)||n(e,...t)),a||(s.current=e)};"function"==typeof e?(console.warn("We can not support a function callback. See Github Issues for details https://github.com/adobe/react-spectrum/issues/2320"),l(((n,...l)=>{const r=e(a?s.current:n,...l);return o(r,...t),a?n:r}))):(a||l(e),o(e,...t))}),[a,n]);return a?s.current=e:e=o,[e,i]}const j=({heading:t=!1,children:n,...o})=>t?(0,e.createElement)("th",{...o},n):(0,e.createElement)("td",{...o},n);var U=({items:t,columns:n,sortableColumns:o=[],idCol:c="id",rowClasses:a=(e=>[`item-${e.id}`]),renderCell:s=((e,t)=>t[e]),noItemsText:u=(0,i.__)("No items found.","content-control"),showBulkSelect:m=!0,className:d,selectedItems:p=[],onSelectItems:h=(()=>{})})=>{var v;const f={[c]:null!==(v=n[c])&&void 0!==v?v:"",...n},E=Object.keys(f).length,[b,w]=H(p,[],h),[_,S]=(0,g.useState)(o.length?o[0]:null),[C,y]=(0,g.useState)("ASC");(0,g.useEffect)((()=>{h(b)}),[b,h]);const k=_?t.sort(((e,t)=>"ASC"===C?e[_]>t[_]?1:-1:t[_]>e[_]?1:-1)):t,x=({header:n=!1})=>(0,e.createElement)(e.Fragment,null,Object.entries(f).map((([a,s])=>{const i=m&&a===c,u=a===_,d=!i&&o.indexOf(a)>=0,p={key:a,heading:!i,id:n&&!i?a:void 0,scope:i?void 0:"col",className:l()([`column-${a}`,...!i&&d?["sortable",C.toLowerCase()]:[],i&&"check-column"])},g=()=>(0,e.createElement)(e.Fragment,null,"function"==typeof s?s():(0,e.createElement)(e.Fragment,null,(0,e.createElement)("span",null,s),u&&(0,e.createElement)(r.Icon,{icon:"ASC"===C?A:V,size:16})));return(0,e.createElement)(j,{...p,key:a},i&&(0,e.createElement)(r.CheckboxControl,{onChange:e=>w(e?t.map((e=>e.id)):[]),checked:b.length>0&&b.length===t.length,indeterminate:b.length>0&&b.length<t.length}),!i&&d&&(0,e.createElement)(r.Button,{variant:"link",onClick:()=>{_===a?y("ASC"===C?"DESC":"ASC"):(S(a),y("ASC"))}},(0,e.createElement)(g,null)),!i&&!d&&(0,e.createElement)(g,null))})));return(0,e.createElement)("table",{className:l()([d,"component-list-table","list-table",0===k.length&&"no-items"])},(0,e.createElement)("thead",null,(0,e.createElement)("tr",null,(0,e.createElement)(x,{header:!0}))),(0,e.createElement)("tbody",null,k.length?k.map(((t,n)=>(0,e.createElement)("tr",{key:t.id,className:l()(a(t))},Object.entries(f).map((([o])=>{const a=o===c;return(0,e.createElement)(j,{key:o,heading:a,className:l()([`column-${o}`,m&&a&&"check-column"]),scope:a?"row":void 0},a?(0,e.createElement)(r.CheckboxControl,{onChange:e=>{const n=e?[...b,t.id]:b.filter((e=>e!==t.id));w(n)},checked:b.indexOf(t.id)>=0}):s(o,t,n))}))))):(0,e.createElement)("tr",null,(0,e.createElement)("td",{colSpan:E},u))),(0,e.createElement)("tfoot",null,(0,e.createElement)("tr",null,(0,e.createElement)(x,null))))},q=t=>{const{text:n="",highlight:o=""}=t,l=(Array.isArray(o)?o:[o]).map((e=>e.trim())).filter((e=>!!e)).map((e=>(0,I.escapeRegExp)(e)));if(!l.length)return(0,e.createElement)(e.Fragment,null,n);const r=new RegExp(`(${l.join("|")})`,"gi");return(0,g.createInterpolateElement)(n.replace(r,"<mark>$&</mark>"),{mark:(0,e.createElement)("mark",null)})};const G=({id:t,label:n,value:o,onChange:a,className:s,options:i=[],orientation:u="horizontal",equalWidth:m=!1,spacing:d,hideLabelFromVision:p=!1})=>{const g=(0,c.useInstanceId)(G);return(0,e.createElement)(r.BaseControl,{id:t||`radio-button-control-${g}`,label:n,className:l()("components-radio-button-control",u,m&&"equal-width",s),hideLabelFromVision:p},(0,e.createElement)("div",{className:"options",style:d?{gap:`${d}px`}:void 0},i.map((({label:t,value:n})=>(0,e.createElement)(r.Button,{key:n,variant:n===o?"primary":"secondary",onClick:()=>a(n)},t)))))};var K=G,Z=(0,e.createElement)(v.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,e.createElement)(v.Path,{d:"M6.5 12.4L12 8l5.5 4.4-.9 1.2L12 10l-4.5 3.6-1-1.2z"})),W=(0,e.createElement)(v.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,e.createElement)(v.Path,{d:"M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"}));const J=({label:t="",placeholder:n="",searchIcon:o,value:a=[],options:s=[],onChange:u=(()=>{}),className:m=""})=>{const d=(0,c.useInstanceId)(J),[p,h]=(0,g.useState)(""),[v,f]=(0,g.useState)("ASC"),E=e=>-1!==a.indexOf(e),b=e=>u(E(e)?[...a.filter((t=>t!==e))]:[...a,e]),w=s.filter((({label:e,value:t,keywords:n})=>e.includes(p)||"string"==typeof t&&t.includes(p)||n&&n.includes(p))),_=w.sort(((e,t)=>"ASC"===v?e.label>t.label?1:-1:t.label>e.label?1:-1));return(0,e.createElement)(r.BaseControl,{id:`searchable-multicheck-control-${d}`,label:t,className:l()(["component-searchable-multicheck-control",m])},(0,e.createElement)("div",{className:"select-actions"},(0,e.createElement)(r.Button,{variant:"link",text:(0,i.__)("Select All","content-control"),onClick:()=>{const e=w.map((({value:e})=>e)),t=[...a,...e];u([...new Set(t)])}}),(0,e.createElement)(r.Button,{variant:"link",text:(0,i.__)("Deselect All","content-control"),onClick:()=>{const e=w.map((({value:e})=>e)),t=[...a.filter((t=>-1===e.indexOf(t)))];u([...new Set(t)])}})),(0,e.createElement)("div",{className:l()([o?"icon-input":null])},(0,e.createElement)("input",{type:"text",className:"components-text-control__input",placeholder:n,value:p,onChange:e=>h(e.target.value)}),o&&(0,e.createElement)(r.Icon,{icon:o})),(0,e.createElement)("table",null,(0,e.createElement)("thead",null,(0,e.createElement)("tr",null,(0,e.createElement)("th",{className:"label-column"},(0,e.createElement)(r.Button,{text:(0,i.__)("Name","content-control"),onClick:()=>f("DESC"===v?"ASC":"DESC"),icon:"DESC"===v?Z:W,iconPosition:"right"})),(0,e.createElement)("td",{className:"cb-column"}))),(0,e.createElement)("tbody",null,_.map((({label:t,value:n})=>(0,e.createElement)("tr",{key:n.toString()},(0,e.createElement)("td",null,(0,e.createElement)("span",{role:"button",tabIndex:-1,onClick:()=>b(n),onKeyDown:()=>{}},t)),(0,e.createElement)("th",{className:"cb-column"},(0,e.createElement)(r.CheckboxControl,{checked:E(n),onChange:()=>b(n)}))))))))};var Q=J}(),(window.contentControl=window.contentControl||{}).components=o}();