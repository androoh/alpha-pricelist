(()=>{"use strict";var e,t,r,o,a,n,i={},d={};function u(e){var t=d[e];if(void 0!==t)return t.exports;var r=d[e]={id:e,loaded:!1,exports:{}};return i[e].call(r.exports,r,r.exports,u),r.loaded=!0,r.exports}u.m=i,e=[],u.O=(t,r,o,a)=>{if(!r){var n=1/0;for(l=0;l<e.length;l++){for(var[r,o,a]=e[l],i=!0,d=0;d<r.length;d++)(!1&a||n>=a)&&Object.keys(u.O).every(e=>u.O[e](r[d]))?r.splice(d--,1):(i=!1,a<n&&(n=a));i&&(e.splice(l--,1),t=o())}return t}a=a||0;for(var l=e.length;l>0&&e[l-1][2]>a;l--)e[l]=e[l-1];e[l]=[r,o,a]},u.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return u.d(t,{a:t}),t},r=Object.getPrototypeOf?e=>Object.getPrototypeOf(e):e=>e.__proto__,u.t=function(e,o){if(1&o&&(e=this(e)),8&o)return e;if("object"==typeof e&&e){if(4&o&&e.__esModule)return e;if(16&o&&"function"==typeof e.then)return e}var a=Object.create(null);u.r(a);var n={};t=t||[null,r({}),r([]),r(r)];for(var i=2&o&&e;"object"==typeof i&&!~t.indexOf(i);i=r(i))Object.getOwnPropertyNames(i).forEach(t=>n[t]=()=>e[t]);return n.default=()=>e,u.d(a,n),a},u.d=(e,t)=>{for(var r in t)u.o(t,r)&&!u.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},u.f={},u.e=e=>Promise.all(Object.keys(u.f).reduce((t,r)=>(u.f[r](e,t),t),[])),u.u=e=>e+"."+{161:"c8fa433dd0f99d238229",253:"f5203ee6b0b0322228d1",608:"ffffa2bd634c47ae3e68",726:"810a8aadadb0ecd9c4ba"}[e]+".js",u.miniCssF=e=>"styles.15cc5b66cbb59a535101.css",u.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),o={},a="nguide-pricelist-ui:",u.l=(e,t,r,n)=>{if(o[e])o[e].push(t);else{var i,d;if(void 0!==r)for(var l=document.getElementsByTagName("script"),c=0;c<l.length;c++){var s=l[c];if(s.getAttribute("src")==e||s.getAttribute("data-webpack")==a+r){i=s;break}}i||(d=!0,(i=document.createElement("script")).charset="utf-8",i.timeout=120,u.nc&&i.setAttribute("nonce",u.nc),i.setAttribute("data-webpack",a+r),i.src=u.tu(e)),o[e]=[t];var f=(t,r)=>{i.onerror=i.onload=null,clearTimeout(p);var a=o[e];if(delete o[e],i.parentNode&&i.parentNode.removeChild(i),a&&a.forEach(e=>e(r)),t)return t(r)},p=setTimeout(f.bind(null,void 0,{type:"timeout",target:i}),12e4);i.onerror=f.bind(null,i.onerror),i.onload=f.bind(null,i.onload),d&&document.head.appendChild(i)}},u.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},u.nmd=e=>(e.paths=[],e.children||(e.children=[]),e),u.tu=e=>(void 0===n&&(n={createScriptURL:e=>e},"undefined"!=typeof trustedTypes&&trustedTypes.createPolicy&&(n=trustedTypes.createPolicy("angular#bundler",n))),n.createScriptURL(e)),u.p="/assets/angular/",(()=>{var e={666:0};u.f.j=(t,r)=>{var o=u.o(e,t)?e[t]:void 0;if(0!==o)if(o)r.push(o[2]);else if(666!=t){var a=new Promise((r,a)=>o=e[t]=[r,a]);r.push(o[2]=a);var n=u.p+u.u(t),i=new Error;u.l(n,r=>{if(u.o(e,t)&&(0!==(o=e[t])&&(e[t]=void 0),o)){var a=r&&("load"===r.type?"missing":r.type),n=r&&r.target&&r.target.src;i.message="Loading chunk "+t+" failed.\n("+a+": "+n+")",i.name="ChunkLoadError",i.type=a,i.request=n,o[1](i)}},"chunk-"+t,t)}else e[t]=0},u.O.j=t=>0===e[t];var t=(t,r)=>{var o,a,[n,i,d]=r,l=0;for(o in i)u.o(i,o)&&(u.m[o]=i[o]);if(d)var c=d(u);for(t&&t(r);l<n.length;l++)u.o(e,a=n[l])&&e[a]&&e[a][0](),e[n[l]]=0;return u.O(c)},r=self.webpackChunknguide_pricelist_ui=self.webpackChunknguide_pricelist_ui||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))})()})();