(self.webpackChunknguide_pricelist_ui=self.webpackChunknguide_pricelist_ui||[]).push([[867],{5867:(e,i,t)=>{"use strict";t.r(i),t.d(i,{PricesModule:()=>k});var r=t(8583),o=t(7029),s=t(6215),n=t(7716),c=t(3647),l=t(3679);let a=(()=>{class e{constructor(e){this.bsModalRef=e,this.selectedPriceModifier={type:"discount",value:0,valueType:"%"},this.priceModifier=new s.X(null)}modifyPrices(){this.priceModifier.next(this.selectedPriceModifier)}}return e.\u0275fac=function(i){return new(i||e)(n.Y36(c.UZ))},e.\u0275cmp=n.Xpm({type:e,selectors:[["app-modify-price"]],decls:27,vars:7,consts:[[1,"modal-header"],[1,"modal-title"],["type","button","aria-label","Close",1,"btn-close",3,"click"],[1,"modal-body"],["for","actionType"],["id","actionType","name","actionType",1,"form-select",3,"ngModel","ngModelChange"],["value","increase",3,"ngValue"],["value","discount",3,"ngValue"],["for","value"],["id","value","type","number",1,"form-control",3,"ngModel","ngModelChange"],["value","%",3,"ngValue"],["value","value",3,"ngValue"],[1,"modal-footer"],["type","button",1,"btn","btn-primary",3,"click"],["type","button",1,"btn","btn-secondary",3,"click"]],template:function(e,i){1&e&&(n.TgZ(0,"div",0),n.TgZ(1,"h5",1),n._uU(2,"Modify prices"),n.qZA(),n.TgZ(3,"button",2),n.NdJ("click",function(){return i.bsModalRef.hide()}),n.qZA(),n.qZA(),n.TgZ(4,"div",3),n.TgZ(5,"label",4),n._uU(6,"Action Type"),n.qZA(),n.TgZ(7,"select",5),n.NdJ("ngModelChange",function(e){return i.selectedPriceModifier.type=e}),n.TgZ(8,"option",6),n._uU(9,"Increase"),n.qZA(),n.TgZ(10,"option",7),n._uU(11,"Discount"),n.qZA(),n.qZA(),n.TgZ(12,"label",8),n._uU(13,"Value"),n.qZA(),n.TgZ(14,"input",9),n.NdJ("ngModelChange",function(e){return i.selectedPriceModifier.value=e}),n.qZA(),n.TgZ(15,"label",4),n._uU(16,"Value Type"),n.qZA(),n.TgZ(17,"select",5),n.NdJ("ngModelChange",function(e){return i.selectedPriceModifier.valueType=e}),n.TgZ(18,"option",10),n._uU(19,"%"),n.qZA(),n.TgZ(20,"option",11),n._uU(21,"value"),n.qZA(),n.qZA(),n.qZA(),n.TgZ(22,"div",12),n.TgZ(23,"button",13),n.NdJ("click",function(){return i.modifyPrices()}),n._uU(24," Apply "),n.qZA(),n.TgZ(25,"button",14),n.NdJ("click",function(){return i.bsModalRef.hide()}),n._uU(26," Cancel "),n.qZA(),n.qZA()),2&e&&(n.xp6(7),n.Q6J("ngModel",i.selectedPriceModifier.type),n.xp6(1),n.Q6J("ngValue","increase"),n.xp6(2),n.Q6J("ngValue","discount"),n.xp6(4),n.Q6J("ngModel",i.selectedPriceModifier.value),n.xp6(3),n.Q6J("ngModel",i.selectedPriceModifier.valueType),n.xp6(1),n.Q6J("ngValue","%"),n.xp6(2),n.Q6J("ngValue","value"))},directives:[l.EJ,l.JJ,l.On,l.YN,l.Kr,l.wV,l.Fj],styles:[""]}),e})();var d=t(4511),p=t(264),u=t(2340),h=t(1841);let g=(()=>{class e{constructor(e){this.http=e}getPriceListProductModelsAndOptions(e){return this.http.get(u.N.apiBaseURL+"prices/"+e)}savePrices(e,i){return this.http.put(u.N.apiBaseURL+"prices/"+e,{prices:i})}}return e.\u0275fac=function(i){return new(i||e)(n.LFG(h.eN))},e.\u0275prov=n.Yz7({token:e,factory:e.\u0275fac,providedIn:"root"}),e})();var m=t(1873);function f(e,i){if(1&e){const e=n.EpF();n.ynx(0),n.TgZ(1,"td"),n.TgZ(2,"label"),n._uU(3,"Delivery price"),n.qZA(),n.TgZ(4,"input",13),n.NdJ("ngModelChange",function(i){n.CHM(e);const t=n.oxw().$implicit;return n.oxw(2).pricesModel[t.id].delivery_price=i}),n.qZA(),n.TgZ(5,"label"),n._uU(6,"Installation price"),n.qZA(),n.TgZ(7,"input",13),n.NdJ("ngModelChange",function(i){n.CHM(e);const t=n.oxw().$implicit;return n.oxw(2).pricesModel[t.id].installation_price=i}),n.qZA(),n.qZA(),n.TgZ(8,"td"),n.TgZ(9,"label"),n.TgZ(10,"input",14),n.NdJ("ngModelChange",function(i){n.CHM(e);const t=n.oxw().$implicit;return n.oxw(2).pricesModel[t.id].delivery_price_on_demand=i}),n.qZA(),n._uU(11," Delivery price "),n.qZA(),n.TgZ(12,"label"),n.TgZ(13,"input",14),n.NdJ("ngModelChange",function(i){n.CHM(e);const t=n.oxw().$implicit;return n.oxw(2).pricesModel[t.id].installation_price_on_demand=i}),n.qZA(),n._uU(14," Installation price "),n.qZA(),n.qZA(),n.BQk()}if(2&e){const e=n.oxw().$implicit,i=n.oxw(2);n.xp6(4),n.Q6J("ngModel",i.pricesModel[e.id].delivery_price),n.xp6(3),n.Q6J("ngModel",i.pricesModel[e.id].installation_price),n.xp6(3),n.Q6J("ngModel",i.pricesModel[e.id].delivery_price_on_demand),n.xp6(3),n.Q6J("ngModel",i.pricesModel[e.id].installation_price_on_demand)}}function Z(e,i){if(1&e){const e=n.EpF();n.ynx(0),n.TgZ(1,"td"),n.TgZ(2,"input",13),n.NdJ("ngModelChange",function(i){n.CHM(e);const t=n.oxw().$implicit;return n.oxw(2).pricesModel[t.id].value=i}),n.qZA(),n.qZA(),n.TgZ(3,"td"),n.TgZ(4,"input",14),n.NdJ("ngModelChange",function(i){n.CHM(e);const t=n.oxw().$implicit;return n.oxw(2).pricesModel[t.id].onDemand=i}),n.qZA(),n.qZA(),n.BQk()}if(2&e){const e=n.oxw().$implicit,i=n.oxw(2);n.xp6(2),n.Q6J("ngModel",i.pricesModel[e.id].value),n.xp6(2),n.Q6J("ngModel",i.pricesModel[e.id].onDemand)}}function b(e,i){if(1&e){const e=n.EpF();n.TgZ(0,"tr"),n.TgZ(1,"td"),n.TgZ(2,"input",11),n.NdJ("ngModelChange",function(i){const t=n.CHM(e).$implicit;return n.oxw(2).pricesModel[t.id].selected=i}),n.qZA(),n.qZA(),n.TgZ(3,"td"),n._uU(4),n.qZA(),n.TgZ(5,"td"),n._uU(6),n.qZA(),n.YNc(7,f,15,4,"ng-container",12),n.YNc(8,Z,5,2,"ng-container",12),n.qZA()}if(2&e){const e=i.$implicit,t=n.oxw(2);n.xp6(2),n.Q6J("ngModel",t.pricesModel[e.id].selected),n.xp6(2),n.Oqu(e.name||"-"),n.xp6(2),n.Oqu(e.sku),n.xp6(1),n.Q6J("ngIf","product_main"===e.type),n.xp6(1),n.Q6J("ngIf","product_main"!==e.type)}}function v(e,i){if(1&e){const e=n.EpF();n.TgZ(0,"table",7),n.TgZ(1,"thead"),n.TgZ(2,"tr"),n.TgZ(3,"th"),n.TgZ(4,"input",8),n.NdJ("input",function(i){return n.CHM(e),n.oxw().selectAll(i)}),n.qZA(),n.qZA(),n.TgZ(5,"th"),n._uU(6,"Name"),n.qZA(),n.TgZ(7,"th"),n._uU(8,"Sku"),n.qZA(),n.TgZ(9,"th",9),n._uU(10,"Price"),n.qZA(),n.TgZ(11,"th"),n._uU(12,"On Demand"),n.qZA(),n.qZA(),n.qZA(),n.TgZ(13,"tbody"),n.YNc(14,b,9,5,"tr",10),n.qZA(),n.qZA()}if(2&e){const e=n.oxw();n.xp6(14),n.Q6J("ngForOf",e.priceLists)}}let M=(()=>{class e{constructor(e,i,t,r,o,s){this.resourcesService=e,this.modalService=i,this.activatedRoute=t,this.pricesService=r,this.breadcrumbService=o,this.alertsService=s,this.priceLists=[],this.pricesModel={},this.priceListId=null,this.defaultLocale="nl"}ngOnInit(){this.activatedRoute.paramMap.subscribe(e=>{this.priceListId=e.get("id"),this.priceListId&&(this.initBreadcrumb(),this.loadData(this.priceListId))})}loadData(e){this.pricesService.getPriceListProductModelsAndOptions(e).subscribe(e=>{var i,t,r,o,s,n;this.priceLists=e.data,this.defaultLocale=e.defaultLocale;for(let c of this.priceLists)if("product_main"===c.type){const e={selected:!1,delivery_price:(null===(i=c.price)||void 0===i?void 0:i.delivery_price)||0,installation_price:(null===(t=c.price)||void 0===t?void 0:t.installation_price)||0,delivery_price_on_demand:(null===(r=c.price)||void 0===r?void 0:r.delivery_price_on_demand)||!1,installation_price_on_demand:(null===(o=c.price)||void 0===o?void 0:o.installation_price_on_demand)||!1};this.pricesModel[c.id]=e}else{const e={selected:!1,value:(null===(s=c.price)||void 0===s?void 0:s.value)||0,onDemand:(null===(n=c.price)||void 0===n?void 0:n.onDemand)||!1};this.pricesModel[c.id]=e}})}selectAll(e){for(const i in this.pricesModel)this.pricesModel.hasOwnProperty(i)&&(this.pricesModel[i].selected=e.target.checked)}modifyPrices(){this.bsModalRef=this.modalService.show(a,{initialState:{},class:"modal-lg"}),this.bsModalRef.content.priceModifier.subscribe(e=>{if(e){for(const i in this.pricesModel)this.pricesModel.hasOwnProperty(i)&&this.pricesModel[i].selected&&(this.pricesModel[i].hasOwnProperty("delivery_price")||this.pricesModel[i].hasOwnProperty("installation_price")?(this.pricesModel[i].delivery_price=this.applyModifier(Number(this.pricesModel[i].delivery_price),e),this.pricesModel[i].installation_price=this.applyModifier(Number(this.pricesModel[i].installation_price),e)):this.pricesModel[i].value=this.applyModifier(Number(this.pricesModel[i].value),e));this.bsModalRef.hide()}})}applyModifier(e,i){let t=Number(i.value);return"%"===i.valueType&&(t=t*e/100),"discount"===i.type?e-=t:e+=t,(e=Math.round(e))>=100&&(e%10>5?e=10*Math.round(e/10):e%10<5&&(e=5*Math.round(e/5))),e<0?0:e}submit(){this.priceListId&&this.pricesService.savePrices(this.priceListId,this.pricesModel).subscribe(e=>{this.alertsService.show(o.NK.success,"Prices updated!")})}initBreadcrumb(){this.breadcrumbService.setBreadcrumb([{label:"Home",path:["/dashboard"]},{label:"Price lists",path:["/resources/priceList"]},{label:"Edit Price list",path:[`/resources/priceList/${this.priceListId}/edit`]},{label:"Assign Prices",path:[`/price-assign/${this.priceListId}`]}]),this.breadcrumbService.update()}}return e.\u0275fac=function(i){return new(i||e)(n.Y36(d.z6),n.Y36(c.tT),n.Y36(p.gz),n.Y36(g),n.Y36(m.p),n.Y36(o.ml))},e.\u0275cmp=n.Xpm({type:e,selectors:[["app-price-assign"]],decls:11,vars:3,consts:[[1,"pt-4","row","sticky-top","bg-white","overflow-hidden","pb-2","border-bottom"],[1,"col-9"],[1,"col-3","text-end"],["type","button",1,"btn","btn-primary","submit-button","me-2",3,"disabled","click"],[1,"bi","bi-save"],["type","button",1,"btn","btn-primary","submit-button",3,"disabled","click"],["class","table mt-2",4,"ngIf"],[1,"table","mt-2"],["type","checkbox",3,"input"],[2,"width","200px"],[4,"ngFor","ngForOf"],["type","checkbox","title","Select All",3,"ngModel","ngModelChange"],[4,"ngIf"],["type","number",1,"form-control","form-control-sm",3,"ngModel","ngModelChange"],["type","checkbox",1,"form-check-input",3,"ngModel","ngModelChange"]],template:function(e,i){1&e&&(n.TgZ(0,"div",0),n.TgZ(1,"h2",1),n._uU(2,"Assign Prices"),n.qZA(),n.TgZ(3,"div",2),n.TgZ(4,"button",3),n.NdJ("click",function(){return i.modifyPrices()}),n._UZ(5,"i",4),n._uU(6," Modify prices "),n.qZA(),n.TgZ(7,"button",5),n.NdJ("click",function(){return i.submit()}),n._UZ(8,"i",4),n._uU(9," Save "),n.qZA(),n.qZA(),n.qZA(),n.YNc(10,v,15,1,"table",6)),2&e&&(n.xp6(4),n.Q6J("disabled",!i.priceListId),n.xp6(3),n.Q6J("disabled",!i.priceListId),n.xp6(3),n.Q6J("ngIf",i.priceLists.length>0))},directives:[r.O5,r.sg,l.Wl,l.JJ,l.On,l.wV,l.Fj],styles:[""]}),e})();var A=t(8550),y=t(6715),w=t(3500),_=t(2114),T=t(6661),x=t(4463),q=t(5790),J=t(9075);const C=["iframe"];function U(e,i){if(1&e&&(n.TgZ(0,"option",16),n._uU(1),n.qZA()),2&e){const e=i.$implicit;n.Q6J("value",e.key),n.xp6(1),n.Oqu(e.value)}}function L(e,i){if(1&e&&(n.TgZ(0,"option",16),n._uU(1),n.qZA()),2&e){const e=i.$implicit;n.Q6J("value",e),n.xp6(1),n.Oqu(e)}}function N(e,i){if(1&e&&(n.TgZ(0,"option",16),n._uU(1),n.qZA()),2&e){const e=i.$implicit;n.Q6J("value",e),n.xp6(1),n.Oqu(e)}}const I=[{path:":id",component:M},{path:"preview/:id",component:(()=>{class e{constructor(e,i,t,r,o){this.ref=e,this.activatedRoute=i,this.sanitizer=t,this.breadcrumbService=r,this.resourcesService=o,this.priceListId=null,this.resourceName="priceList",this.templateUrl="",this.iframeLoaded=!1,this.locales=[],this.defaultLocale="nl",this.resourceInfo=null,this.pageSizes=["A0","A1","A2","A3","A4","A5","A6","A7","A10","B4","B5","letter","legal","ledger"],this.pageOrientations=["portrait","landscape"],this.model={},this.mainUrl="",this.form=new l.cw({locale:new l.NI(""),pageSize:new l.NI("A4"),showCropBorders:new l.NI(!1),showCross:new l.NI(!1),pageOrientation:new l.NI("portrait")})}ngOnInit(){this.activatedRoute.paramMap.subscribe(e=>{this.priceListId=e.get("id"),this.resourceName&&this.resourcesService.getResourceInfo(this.resourceName).subscribe(e=>{this.resourceInfo=e,this.initBreadcrumb(),this.priceListId&&this.resourcesService.getEditResourceSchema(this.resourceName,this.priceListId).subscribe(e=>{var i,t;this.defaultLocale=e.defaultLocale,null===(i=this.form.get("locale"))||void 0===i||i.setValue(this.defaultLocale),this.model=null==e?void 0:e.data,this.locales=this.mapLocales(e.locales,(null===(t=this.model)||void 0===t?void 0:t.language)||[]),this.mainUrl=u.N.apiBaseURL+"resources/"+this.resourceName+"/"+this.priceListId+"/html?path=&template=pricelist",this.updateTemplateUrl(this.form.value)})})}),this.form.valueChanges.subscribe(e=>{e&&this.updateTemplateUrl(e)})}updateTemplateUrl(e){const i={locale:(null==e?void 0:e.locale)||"nl",pageSize:(null==e?void 0:e.pageSize)||"A4",showCropBorders:(null==e?void 0:e.showCropBorders)||!1,showCross:(null==e?void 0:e.showCross)||!1,pageOrientation:(null==e?void 0:e.pageOrientation)||"portrait"},t=[];this.iframeLoaded=!1;for(const r in i)t.push(r+"="+i[r]);this.ref.reattach(),this.templateUrl=this.mainUrl+"&"+t.join("&")}getPreviewURL(){const e=this.sanitizer.bypassSecurityTrustResourceUrl(this.templateUrl);return this.templateUrl&&this.ref.detach(),e}mapLocales(e,i){const t=[];for(const r in e)i.includes(r)&&t.push({key:r,value:e[r]});return t}initBreadcrumb(){this.breadcrumbService.setBreadcrumb([{label:"Home",path:["/dashboard"]},{label:"Price lists",path:["/resources/priceList"]},{label:"Edit Price list",path:[`/resources/priceList/${this.priceListId}/edit`]},{label:"Preview Price List",path:[`/price-assign/preview/${this.priceListId}`]}]),this.breadcrumbService.update()}print(){window.open(this.templateUrl,"_blank")}setIframeLoaded(){}}return e.\u0275fac=function(i){return new(i||e)(n.Y36(n.sBO),n.Y36(p.gz),n.Y36(J.H7),n.Y36(m.p),n.Y36(d.z6))},e.\u0275cmp=n.Xpm({type:e,selectors:[["app-preview"]],viewQuery:function(e,i){if(1&e&&n.Gf(C,5),2&e){let e;n.iGM(e=n.CRH())&&(i.iframe=e.first)}},decls:24,vars:10,consts:[[1,"d-flex","flex-column","h-100"],[1,"pt-4","row","sticky-top","bg-white","overflow-hidden","border-bottom","pb-2"],[1,"col-3","mb-0"],[1,"col-9","text-end","row","g-3","m-0"],[1,"form-select","col","me-2","mt-0",3,"formControl"],[3,"value",4,"ngFor","ngForOf"],["title","Show Crop Borders",1,"form-check","col","me-2","mt-2"],["type","checkbox","id","showCropBorders",1,"form-check-input",3,"formControl"],["for","showCropBorders",1,"form-check-label","text-truncate"],["title","Show Crop Cross",1,"form-check","col","me-2","mt-2"],["type","checkbox","id","showCross",1,"form-check-input",3,"formControl"],["for","showCross",1,"form-check-label","text-truncate"],["type","button",1,"btn","btn-primary","col","me-2","mt-0",3,"click"],[1,"bi","bi-printer"],[1,"mt-3","flex-grow-1",3,"src","load"],["iframe",""],[3,"value"]],template:function(e,i){1&e&&(n.TgZ(0,"div",0),n.TgZ(1,"div",1),n.TgZ(2,"h2",2),n._uU(3),n.qZA(),n.TgZ(4,"div",3),n.TgZ(5,"select",4),n.YNc(6,U,2,2,"option",5),n.qZA(),n.TgZ(7,"select",4),n.YNc(8,L,2,2,"option",5),n.qZA(),n.TgZ(9,"select",4),n.YNc(10,N,2,2,"option",5),n.qZA(),n.TgZ(11,"div",6),n._UZ(12,"input",7),n.TgZ(13,"label",8),n._uU(14," Show Crop Borders "),n.qZA(),n.qZA(),n.TgZ(15,"div",9),n._UZ(16,"input",10),n.TgZ(17,"label",11),n._uU(18," Show Crop Cross "),n.qZA(),n.qZA(),n.TgZ(19,"button",12),n.NdJ("click",function(){return i.print()}),n._UZ(20,"i",13),n._uU(21," Print "),n.qZA(),n.qZA(),n.qZA(),n.TgZ(22,"iframe",14,15),n.NdJ("load",function(){return i.setIframeLoaded()}),n.qZA(),n.qZA()),2&e&&(n.xp6(3),n.hij("Preview ",null==i.resourceInfo?null:i.resourceInfo.label,""),n.xp6(2),n.Q6J("formControl",i.form.get("locale")),n.xp6(1),n.Q6J("ngForOf",i.locales),n.xp6(1),n.Q6J("formControl",i.form.get("pageSize")),n.xp6(1),n.Q6J("ngForOf",i.pageSizes),n.xp6(1),n.Q6J("formControl",i.form.get("pageOrientation")),n.xp6(1),n.Q6J("ngForOf",i.pageOrientations),n.xp6(2),n.Q6J("formControl",i.form.get("showCropBorders")),n.xp6(4),n.Q6J("formControl",i.form.get("showCross")),n.xp6(6),n.Q6J("src",i.getPreviewURL(),n.uOi))},directives:[l.EJ,l.JJ,l.oH,r.sg,l.Wl,l.YN,l.Kr],styles:["[_nghost-%COMP%]{width:100%;height:100%}"],changeDetection:0}),e})()}];let k=(()=>{class e{}return e.\u0275fac=function(i){return new(i||e)},e.\u0275mod=n.oAB({type:e}),e.\u0275inj=n.cJS({imports:[[r.ez,l.u5,A.xD,p.Bz.forChild(I),l.UX,y.z$,w.X0.forChild({extras:{lazyRender:!0},wrappers:[{name:"panel",component:_.Z}],types:[{name:"images",component:T.Pw,wrappers:["form-field"]},{name:"repeat",component:x.$},{name:"hasMany",component:q.a}]})]]}),e})()}}]);