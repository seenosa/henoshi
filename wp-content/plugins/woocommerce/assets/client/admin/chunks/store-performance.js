"use strict";(globalThis.webpackChunk_wcAdmin_webpackJsonp=globalThis.webpackChunk_wcAdmin_webpackJsonp||[]).push([[2624],{87950:(e,r,t)=>{t.r(r),t.d(r,{default:()=>g});var a=t(69307),n=t(65736),o=t(94333),s=t(10431),i=t(9818),c=t(86020),l=t(81921),m=t(14599),d=t(20964),u=t(92434),p=t(27182);const{performanceIndicators:y}=(0,p.O3)("dataEndpoints",{performanceIndicators:[]});class f extends a.Component{renderMenu(){const{hiddenBlocks:e,isFirst:r,isLast:t,onMove:o,onRemove:s,onTitleBlur:i,onTitleChange:l,onToggleHiddenBlock:d,titleInput:u,controls:p}=this.props;return(0,a.createElement)(c.EllipsisMenu,{label:(0,n.__)("Choose which analytics to display and the section name","woocommerce"),renderContent:f=>{let{onToggle:g}=f;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(c.MenuTitle,null,(0,n.__)("Display stats:","woocommerce")),y.map(((r,t)=>{const n=!e.includes(r.stat);return(0,a.createElement)(c.MenuItem,{checked:n,isCheckbox:!0,isClickable:!0,key:t,onInvoke:()=>{d(r.stat)(),(0,m.recordEvent)("dash_indicators_toggle",{status:n?"off":"on",key:r.stat})}},r.label)})),(0,a.createElement)(p,{onToggle:g,onMove:o,onRemove:s,isFirst:r,isLast:t,onTitleBlur:i,onTitleChange:l,titleInput:u}))}})}renderList(){const{query:e,primaryRequesting:r,secondaryRequesting:t,primaryError:o,secondaryError:i,primaryData:d,secondaryData:p,userIndicators:y,defaultDateRange:f}=this.props;if(r||t)return(0,a.createElement)(c.SummaryListPlaceholder,{numberOfItems:y.length});if(o||i)return null;const g=(0,s.getPersistedQuery)(e),{compare:h}=(0,l.getDateParamsFromQuery)(e,f),_="previous_period"===h?(0,n.__)("Previous period:","woocommerce"):(0,n.__)("Previous year:","woocommerce"),{formatAmount:k,getCurrencyConfig:E}=this.context,v=E();return(0,a.createElement)(c.SummaryList,null,(()=>y.map(((e,r)=>{const{primaryValue:t,secondaryValue:n,delta:o,reportUrl:s,reportUrlType:i}=(0,u.Z)({indicator:e,primaryData:d,secondaryData:p,currency:v,formatAmount:k,persistedQuery:g});return(0,a.createElement)(c.SummaryNumber,{key:r,href:s,hrefType:i,label:e.label,value:t,prevLabel:_,prevValue:n,delta:o,onLinkClickCallback:()=>{(0,m.recordEvent)("dash_indicators_click",{key:e.stat})}})}))))}render(){const{userIndicators:e,title:r}=this.props;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(c.SectionHeader,{title:r||(0,n.__)("Store Performance","woocommerce"),menu:this.renderMenu()}),e.length>0&&(0,a.createElement)("div",{className:"woocommerce-dashboard__store-performance"},this.renderList()))}}f.contextType=d.$;const g=(0,o.compose)((0,i.withSelect)(((e,r)=>{const{hiddenBlocks:t,query:a,filters:n}=r,o=y.filter((e=>!t.includes(e.stat))),s={hiddenBlocks:t,userIndicators:o,indicators:y};if(0===o.length)return s;const i=(0,u.A)(e,o,a,n);return{...s,...i}})))(f)},92434:(e,r,t)=>{t.d(r,{A:()=>u,Z:()=>d});var a=t(76292),n=t.n(a),o=t(92819),s=t(81921),i=t(67221),c=t(10431),l=t(81595),m=t(74617);const d=e=>{let{indicator:r,primaryData:t,secondaryData:a,currency:n,formatAmount:s,persistedQuery:i}=e;const d=(0,o.find)(t.data,(e=>e.stat===r.stat)),u=(0,o.find)(a.data,(e=>e.stat===r.stat));if(!d||!u)return{};const p=d._links&&d._links.report[0]&&d._links.report[0].href||"",y=function(e,r,t){return e?"/jetpack"===e?(0,m.getAdminLink)("admin.php?page=jetpack#/dashboard"):(0,c.getNewPath)(r,e,{chart:t.chart}):""}(p,i,d),f="/jetpack"===p?"wp-admin":"wc-admin",g="currency"===d.format,h=(0,l.calculateDelta)(d.value,u.value);return{primaryValue:g?s(d.value):(0,l.formatValue)(n,d.format,d.value),secondaryValue:g?s(u.value):(0,l.formatValue)(n,u.format,u.value),delta:h,reportUrl:y,reportUrlType:f}},u=(e,r,t,a)=>{const{getReportItems:o,getReportItemsError:c,isResolving:l}=e(i.REPORTS_STORE_NAME),{woocommerce_default_date_range:m}=e(i.SETTINGS_STORE_NAME).getSetting("wc_admin","wcAdminSettings"),d=(0,s.getCurrentDates)(t,m),u=d.primary.before,p=d.secondary.before,y=r.map((e=>e.stat)).join(","),f=(0,i.getFilterQuery)({filters:a,query:t}),g={...f,after:(0,s.appendTimestamp)(d.primary.after,"start"),before:(0,s.appendTimestamp)(u,u.isSame(n()(),"day")?"now":"end"),stats:y},h={...f,after:(0,s.appendTimestamp)(d.secondary.after,"start"),before:(0,s.appendTimestamp)(p,p.isSame(n()(),"day")?"now":"end"),stats:y};return{primaryData:o("performance-indicators",g),primaryError:c("performance-indicators",g)||null,primaryRequesting:l("getReportItems",["performance-indicators",g]),secondaryData:o("performance-indicators",h),secondaryError:c("performance-indicators",h)||null,secondaryRequesting:l("getReportItems",["performance-indicators",h]),defaultDateRange:m}}}}]);