(self.webpackChunknguide_pricelist_ui=self.webpackChunknguide_pricelist_ui||[]).push([[726],{2726:(e,t,s)=>{"use strict";s.r(t),s.d(t,{ResourcesModule:()=>Je});var i=s(8583),o=s(9486),n=s(7029),r=s(3289),a=s(739),l=s(7716),c=s(264),u=s(1873),d=s(8272),h=s(3679),p=s(4395),m=s(7519),f=s(5435),g=s(8935),b=s(1103),v=s(7238),w=s(7435);const _=function(e){return{dropdown:e}},C=["*"];let y=(()=>{class e{constructor(){this.autoClose=!0,this.insideClick=!1,this.isAnimated=!1}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275prov=(0,l.Yz7)({factory:function(){return new e},token:e,providedIn:"root"}),e})(),x=(()=>{class e{constructor(){this.direction="down",this.autoClose=!0,this.insideClick=!1,this.isAnimated=!1,this.isOpenChange=new l.vpe,this.isDisabledChange=new l.vpe,this.toggleClick=new l.vpe,this.dropdownMenu=new Promise(e=>{this.resolveDropdownMenu=e})}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275prov=l.Yz7({token:e,factory:e.\u0275fac}),e})();const I=[(0,v.oB)({height:0,overflow:"hidden"}),(0,v.jt)("220ms cubic-bezier(0, 0, 0.2, 1)",(0,v.oB)({height:"*",overflow:"hidden"}))];let N=(()=>{class e{constructor(e,t,s,i,o){this._state=e,this.cd=t,this._renderer=s,this._element=i,this.isOpen=!1,this._factoryDropDownAnimation=o.build(I),this._subscription=e.isOpenChange.subscribe(e=>{this.isOpen=e;const t=this._element.nativeElement.querySelector(".dropdown-menu");this._renderer.addClass(this._element.nativeElement.querySelector("div"),"open"),t&&!(0,b.XA)()&&(this._renderer.addClass(t,"show"),t.classList.contains("dropdown-menu-right")&&(this._renderer.setStyle(t,"left","auto"),this._renderer.setStyle(t,"right","0")),"up"===this.direction&&(this._renderer.setStyle(t,"top","auto"),this._renderer.setStyle(t,"transform","translateY(-101%)"))),t&&this._state.isAnimated&&this._factoryDropDownAnimation.create(t).play(),this.cd.markForCheck(),this.cd.detectChanges()})}get direction(){return this._state.direction}_contains(e){return this._element.nativeElement.contains(e)}ngOnDestroy(){this._subscription.unsubscribe()}}return e.\u0275fac=function(t){return new(t||e)(l.Y36(x),l.Y36(l.sBO),l.Y36(l.Qsj),l.Y36(l.SBq),l.Y36(v._j))},e.\u0275cmp=l.Xpm({type:e,selectors:[["bs-dropdown-container"]],hostAttrs:[2,"display","block","position","absolute","z-index","1040"],ngContentSelectors:C,decls:2,vars:9,consts:[[3,"ngClass"]],template:function(e,t){1&e&&(l.F$t(),l.TgZ(0,"div",0),l.Hsn(1),l.qZA()),2&e&&(l.ekj("dropup","up"===t.direction)("show",t.isOpen)("open",t.isOpen),l.Q6J("ngClass",l.VKq(7,_,"down"===t.direction)))},directives:[i.mk],encapsulation:2,changeDetection:0}),e})(),Z=(()=>{class e{constructor(e,t,s,i,o,n,r){this._elementRef=e,this._renderer=t,this._viewContainerRef=s,this._cis=i,this._state=o,this._config=n,this.dropup=!1,this._isInlineOpen=!1,this._isDisabled=!1,this._subscriptions=[],this._isInited=!1,this._state.autoClose=this._config.autoClose,this._state.insideClick=this._config.insideClick,this._state.isAnimated=this._config.isAnimated,this._factoryDropDownAnimation=r.build(I),this._dropdown=this._cis.createLoader(this._elementRef,this._viewContainerRef,this._renderer).provide({provide:x,useValue:this._state}),this.onShown=this._dropdown.onShown,this.onHidden=this._dropdown.onHidden,this.isOpenChange=this._state.isOpenChange}set autoClose(e){this._state.autoClose=e}get autoClose(){return this._state.autoClose}set isAnimated(e){this._state.isAnimated=e}get isAnimated(){return this._state.isAnimated}set insideClick(e){this._state.insideClick=e}get insideClick(){return this._state.insideClick}set isDisabled(e){this._isDisabled=e,this._state.isDisabledChange.emit(e),e&&this.hide()}get isDisabled(){return this._isDisabled}get isOpen(){return this._showInline?this._isInlineOpen:this._dropdown.isShown}set isOpen(e){e?this.show():this.hide()}get isBs4(){return!(0,b.XA)()}get _showInline(){return!this.container}ngOnInit(){this._isInited||(this._isInited=!0,this._dropdown.listen({outsideClick:!1,triggers:this.triggers,show:()=>this.show()}),this._subscriptions.push(this._state.toggleClick.subscribe(e=>this.toggle(e))),this._subscriptions.push(this._state.isDisabledChange.pipe((0,f.h)(e=>e)).subscribe(()=>this.hide())))}show(){if(!this.isOpen&&!this.isDisabled)return this._showInline?(this._inlinedMenu||this._state.dropdownMenu.then(e=>{this._dropdown.attachInline(e.viewContainer,e.templateRef),this._inlinedMenu=this._dropdown._inlineViewRef,this.addBs4Polyfills(),this._inlinedMenu&&this._renderer.addClass(this._inlinedMenu.rootNodes[0].parentNode,"open"),this.playAnimation()}).catch(),this.addBs4Polyfills(),this._isInlineOpen=!0,this.onShown.emit(!0),this._state.isOpenChange.emit(!0),void this.playAnimation()):void this._state.dropdownMenu.then(e=>{const t=this.dropup||void 0!==this.dropup&&this.dropup;this._state.direction=t?"up":"down";const s=this.placement||(t?"top start":"bottom start");this._dropdown.attach(N).to(this.container).position({attachment:s}).show({content:e.templateRef,placement:s}),this._state.isOpenChange.emit(!0)}).catch()}hide(){this.isOpen&&(this._showInline?(this.removeShowClass(),this.removeDropupStyles(),this._isInlineOpen=!1,this.onHidden.emit(!0)):this._dropdown.hide(),this._state.isOpenChange.emit(!1))}toggle(e){return this.isOpen||!e?this.hide():this.show()}_contains(e){return this._elementRef.nativeElement.contains(e.target)||this._dropdown.instance&&this._dropdown.instance._contains(e.target)}ngOnDestroy(){for(const e of this._subscriptions)e.unsubscribe();this._dropdown.dispose()}addBs4Polyfills(){(0,b.XA)()||(this.addShowClass(),this.checkRightAlignment(),this.addDropupStyles())}playAnimation(){this._state.isAnimated&&this._inlinedMenu&&setTimeout(()=>{this._inlinedMenu&&this._factoryDropDownAnimation.create(this._inlinedMenu.rootNodes[0]).play()})}addShowClass(){this._inlinedMenu&&this._inlinedMenu.rootNodes[0]&&this._renderer.addClass(this._inlinedMenu.rootNodes[0],"show")}removeShowClass(){this._inlinedMenu&&this._inlinedMenu.rootNodes[0]&&this._renderer.removeClass(this._inlinedMenu.rootNodes[0],"show")}checkRightAlignment(){if(this._inlinedMenu&&this._inlinedMenu.rootNodes[0]){const e=this._inlinedMenu.rootNodes[0].classList.contains("dropdown-menu-right");this._renderer.setStyle(this._inlinedMenu.rootNodes[0],"left",e?"auto":"0"),this._renderer.setStyle(this._inlinedMenu.rootNodes[0],"right",e?"0":"auto")}}addDropupStyles(){this._inlinedMenu&&this._inlinedMenu.rootNodes[0]&&(this._renderer.setStyle(this._inlinedMenu.rootNodes[0],"top",this.dropup?"auto":"100%"),this._renderer.setStyle(this._inlinedMenu.rootNodes[0],"transform",this.dropup?"translateY(-101%)":"translateY(0)"),this._renderer.setStyle(this._inlinedMenu.rootNodes[0],"bottom","auto"))}removeDropupStyles(){this._inlinedMenu&&this._inlinedMenu.rootNodes[0]&&(this._renderer.removeStyle(this._inlinedMenu.rootNodes[0],"top"),this._renderer.removeStyle(this._inlinedMenu.rootNodes[0],"transform"),this._renderer.removeStyle(this._inlinedMenu.rootNodes[0],"bottom"))}}return e.\u0275fac=function(t){return new(t||e)(l.Y36(l.SBq),l.Y36(l.Qsj),l.Y36(l.s_b),l.Y36(g.oj),l.Y36(x),l.Y36(y),l.Y36(v._j))},e.\u0275dir=l.lG2({type:e,selectors:[["","bsDropdown",""],["","dropdown",""]],hostVars:6,hostBindings:function(e,t){2&e&&l.ekj("dropup",t.dropup)("open",t.isOpen)("show",t.isOpen&&t.isBs4)},inputs:{dropup:"dropup",autoClose:"autoClose",isAnimated:"isAnimated",insideClick:"insideClick",isDisabled:"isDisabled",isOpen:"isOpen",placement:"placement",triggers:"triggers",container:"container"},outputs:{onShown:"onShown",onHidden:"onHidden",isOpenChange:"isOpenChange"},exportAs:["bs-dropdown"],features:[l._Bn([x])]}),e})(),k=(()=>{class e{constructor(e,t,s){e.resolveDropdownMenu({templateRef:s,viewContainer:t})}}return e.\u0275fac=function(t){return new(t||e)(l.Y36(x),l.Y36(l.s_b),l.Y36(l.Rgc))},e.\u0275dir=l.lG2({type:e,selectors:[["","bsDropdownMenu",""],["","dropdownMenu",""]],exportAs:["bs-dropdown-menu"]}),e})(),A=(()=>{class e{constructor(e,t,s,i,o){this._changeDetectorRef=e,this._dropdown=t,this._element=s,this._renderer=i,this._state=o,this.isOpen=!1,this._subscriptions=[],this._subscriptions.push(this._state.isOpenChange.subscribe(e=>{this.isOpen=e,e?(this._documentClickListener=this._renderer.listen("document","click",e=>{!this._state.autoClose||2===e.button||this._element.nativeElement.contains(e.target)||this._state.insideClick&&this._dropdown._contains(e)||(this._state.toggleClick.emit(!1),this._changeDetectorRef.detectChanges())}),this._escKeyUpListener=this._renderer.listen(this._element.nativeElement,"keyup.esc",()=>{this._state.autoClose&&(this._state.toggleClick.emit(!1),this._changeDetectorRef.detectChanges())})):(this._documentClickListener&&this._documentClickListener(),this._escKeyUpListener&&this._escKeyUpListener())})),this._subscriptions.push(this._state.isDisabledChange.subscribe(e=>this.isDisabled=e||void 0))}onClick(e){e.stopPropagation(),this.isDisabled||this._state.toggleClick.emit(!0)}ngOnDestroy(){this._documentClickListener&&this._documentClickListener(),this._escKeyUpListener&&this._escKeyUpListener();for(const e of this._subscriptions)e.unsubscribe()}}return e.\u0275fac=function(t){return new(t||e)(l.Y36(l.sBO),l.Y36(Z),l.Y36(l.SBq),l.Y36(l.Qsj),l.Y36(x))},e.\u0275dir=l.lG2({type:e,selectors:[["","bsDropdownToggle",""],["","dropdownToggle",""]],hostVars:3,hostBindings:function(e,t){1&e&&l.NdJ("click",function(e){return t.onClick(e)}),2&e&&l.uIk("aria-haspopup",!0)("aria-expanded",t.isOpen)("disabled",t.isDisabled)},exportAs:["bs-dropdown-toggle"]}),e})(),O=(()=>{class e{static forRoot(){return{ngModule:e,providers:[g.oj,w.sA,x]}}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=l.oAB({type:e}),e.\u0275inj=l.cJS({imports:[[i.ez]]}),e})();var S=s(3500);function Y(e,t){if(1&e&&(l.TgZ(0,"span",7),l._uU(1),l.qZA()),2&e){const e=l.oxw(2);l.xp6(1),l.hij(" ",e.nrFilters," ")}}function q(e,t){if(1&e){const e=l.EpF();l.ynx(0),l.TgZ(1,"form",10),l.NdJ("ngSubmit",function(){return l.CHM(e),l.oxw(3).submit()}),l._UZ(2,"formly-form",11),l.qZA(),l.TgZ(3,"button",12),l.NdJ("click",function(){return l.CHM(e),l.oxw(3).reset()}),l._uU(4,"Reset"),l.qZA(),l.BQk()}if(2&e){const e=l.oxw(3);l.xp6(1),l.Q6J("formGroup",e.form),l.xp6(1),l.Q6J("model",e.model)("fields",e.fields)("options",e.options)("form",e.form)}}function J(e,t){if(1&e&&(l.TgZ(0,"div",8),l.YNc(1,q,5,5,"ng-container",9),l.qZA()),2&e){const e=l.oxw(2);l.xp6(1),l.Q6J("ngIf",e.form&&e.fields)}}function M(e,t){if(1&e&&(l.TgZ(0,"div",1),l.TgZ(1,"button",2),l._UZ(2,"i",3),l._UZ(3,"span",4),l.YNc(4,Y,2,1,"span",5),l.qZA(),l.YNc(5,J,2,1,"div",6),l.qZA()),2&e){const e=l.oxw();l.Q6J("insideClick",!0),l.xp6(4),l.Q6J("ngIf",e.nrFilters>0)}}let T=(()=>{class e{constructor(e){this.resourcesService=e,this.resourceName="",this.filtersChange=new l.vpe,this.form=new h.cw({}),this.model={},this.options={},this.fields=[]}get nrFilters(){return this.resourcesService.nrNonEmptyFilters(this.form.value)}ngOnInit(){this.form.valueChanges.pipe((0,p.b)(700),(0,m.x)()).subscribe(e=>{e&&this.fields&&this.filtersChange.emit(this.resourcesService.getFilterableOptions(e,this.fields))})}ngOnChanges(e){var t;(null===(t=null==e?void 0:e.resourceName)||void 0===t?void 0:t.currentValue)&&this.resourcesService.getFilters(e.resourceName.currentValue).subscribe(e=>{this.fields=e})}reset(){for(const e in this.model)this.model.hasOwnProperty(e)&&(this.model[e]=null);this.form.patchValue(this.model)}submit(){}}return e.\u0275fac=function(t){return new(t||e)(l.Y36(o.z6))},e.\u0275cmp=l.Xpm({type:e,selectors:[["app-filters"]],inputs:{resourceName:"resourceName",filters:"filters"},outputs:{filtersChange:"filtersChange"},features:[l.TTD],decls:1,vars:1,consts:[["class","btn-group","dropdown","","placement","bottom right","container","body",3,"insideClick",4,"ngIf"],["dropdown","","placement","bottom right","container","body",1,"btn-group",3,"insideClick"],["id","button-basic","dropdownToggle","","type","button","aria-controls","dropdown-basic","title","Filter",1,"btn","btn-primary","dropdown-toggle"],[1,"bi","bi-funnel"],[1,"caret"],["class","position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger",4,"ngIf"],["id","dropdown-basic","class","dropdown-menu p-2 filter-dropdown dropdown-menu-right","role","menu","aria-labelledby","button-basic",4,"dropdownMenu"],[1,"position-absolute","top-0","start-100","translate-middle","badge","rounded-pill","bg-danger"],["id","dropdown-basic","role","menu","aria-labelledby","button-basic",1,"dropdown-menu","p-2","filter-dropdown","dropdown-menu-right"],[4,"ngIf"],[3,"formGroup","ngSubmit"],[3,"model","fields","options","form"],[1,"btn","btn-danger","mt-2","w-100",3,"click"]],template:function(e,t){1&e&&l.YNc(0,M,6,2,"div",0),2&e&&l.Q6J("ngIf",t.fields&&t.fields.length)},directives:[i.O5,Z,A,k,h._Y,h.JL,h.sg,S.T7],styles:["[_nghost-%COMP%]     .form-group label{font-size:.8rem}[_nghost-%COMP%]     .form-group .form-control{min-height:calc(1.5em + .5rem + 2px);padding:.25rem .5rem;font-size:.875rem;border-radius:.2rem}"]}),e})();var Q=s(8550);const L=function(){return["create"]};function D(e,t){if(1&e){const e=l.EpF();l.TgZ(0,"div",2),l.TgZ(1,"div",3),l.TgZ(2,"h2",4),l._uU(3),l.qZA(),l.TgZ(4,"div",5),l.TgZ(5,"app-filters",6),l.NdJ("filtersChange",function(t){return l.CHM(e),l.oxw().filtersChange(t)}),l.qZA(),l.TgZ(6,"a",7),l._UZ(7,"i",8),l._uU(8," Create new"),l.qZA(),l.qZA(),l.qZA(),l.qZA()}if(2&e){const e=l.oxw();l.xp6(3),l.Oqu(e.resourceInfo.pluralLabel),l.xp6(2),l.Q6J("resourceName",e.resourceName),l.xp6(1),l.Q6J("routerLink",l.DdM(3,L))}}function U(e,t){1&e&&l.GkF(0)}function R(e,t){if(1&e&&(l.TgZ(0,"div",17),l._uU(1),l.qZA()),2&e){const e=l.oxw().value,t=l.oxw(3);l.Q6J("title",t.getTranslatedValue(e)),l.xp6(1),l.Oqu(t.getTranslatedValue(e))}}function E(e,t){if(1&e&&(l.TgZ(0,"div",17),l._uU(1),l.qZA()),2&e){const e=l.oxw().value;l.Q6J("title",e),l.xp6(1),l.Oqu(e)}}function F(e,t){if(1&e&&(l.YNc(0,U,1,0,"ng-container",14),l.YNc(1,R,2,2,"ng-template",null,15,l.W1O),l.YNc(3,E,2,2,"ng-template",null,16,l.W1O)),2&e){const e=l.MAs(2),t=l.MAs(4),s=l.oxw().$implicit;l.Q6J("ngIf",null==s?null:s.translatable)("ngIfThen",e)("ngIfElse",t)}}function j(e,t){if(1&e&&(l.TgZ(0,"ngx-datatable-column",13),l.YNc(1,F,5,3,"ng-template",12),l.qZA()),2&e){const e=t.$implicit;l.Q6J("name",e.name)("path",e.path)("prop",e.prop)("draggable",e.draggable)("resizeable",e.resizeable)("sortable",e.sortable)("flexGrow",e.flexGrow)}}const H=function(e){return[e,"edit"]};function B(e,t){if(1&e){const e=l.EpF();l.TgZ(0,"div",18),l.TgZ(1,"div",19),l.TgZ(2,"a",20),l._UZ(3,"i",21),l._uU(4," Edit"),l.qZA(),l.TgZ(5,"a",22),l.NdJ("click",function(){const t=l.CHM(e).row;return l.oxw(2).remove(t.id)}),l._UZ(6,"i",23),l._uU(7," Remove"),l.qZA(),l.qZA(),l.qZA()}if(2&e){const e=t.row;l.xp6(2),l.Q6J("routerLink",l.VKq(1,H,e.id))}}function P(e,t){if(1&e){const e=l.EpF();l.TgZ(0,"ngx-datatable",9),l.NdJ("sort",function(t){return l.CHM(e),l.oxw().onSort(t)})("page",function(t){return l.CHM(e),l.oxw().onPaginate(t)}),l.YNc(1,j,2,7,"ngx-datatable-column",10),l.TgZ(2,"ngx-datatable-column",11),l.YNc(3,B,8,3,"ng-template",12),l.qZA(),l.qZA()}if(2&e){const e=l.oxw();l.Q6J("rows",e.rows)("headerHeight","auto")("footerHeight","auto")("rowHeight","auto")("columnMode",e.columnMode)("limit",e.listResponse.per_page)("count",e.listResponse.total)("offset",e.listResponse.current_page-1)("externalSorting",!0)("externalPaging",!0)("loadingIndicator",e.loadingIndicator),l.xp6(1),l.Q6J("ngForOf",e.columns),l.xp6(1),l.Q6J("name","Actions")("draggable",!1)("resizeable",!1)("sortable",!1)("flexGrow",0)}}let V=(()=>{class e extends r.i{constructor(e,t,s,i,o){super(t,o),this.activatedRoute=e,this.resourcesService=t,this.alertsService=s,this.breadcrumbService=i,this.tableService=o}ngOnInit(){(0,a.aj)([this.activatedRoute.paramMap,this.activatedRoute.queryParamMap]).subscribe(([e,t])=>{this.resourceName=e.get("name"),this.filtersData=JSON.parse(t.get("filters","{}")),this.resourceName&&this.resourcesService.getResourceInfo(this.resourceName).subscribe(e=>{this.resourceInfo=e,this.initBreadcrumb(),this.resourceName&&this.loadData(this.resourceName,new o.CE({resource:this.resourceName,filters:this.filtersData}))})})}filtersChange(e){this.resourceName&&e&&this.onFilter(e)}remove(e){confirm("Are you sure you want to remove this item?")&&this.resourceName&&this.resourcesService.removeResource(this.resourceName,e).subscribe(e=>{this.resourceName&&(this.alertsService.show(n.NK.success,"Resource Removed!"),this.resourcesService.onTableData.next(new o.CE({resource:this.resourceName,sorting:this.sort,page:this.page,filters:this.filters})))})}initBreadcrumb(){var e;this.breadcrumbService.setBreadcrumb([{label:"Home",path:["/dashboard"]},{label:(null===(e=this.resourceInfo)||void 0===e?void 0:e.pluralLabel)||"Resource",path:[`/resources/${this.resourceName}`]}]),this.breadcrumbService.update()}}return e.\u0275fac=function(t){return new(t||e)(l.Y36(c.gz),l.Y36(o.z6),l.Y36(n.ml),l.Y36(u.p),l.Y36(d.w))},e.\u0275cmp=l.Xpm({type:e,selectors:[["app-list"]],features:[l.qOj],decls:2,vars:2,consts:[["class","pt-4 row sticky-top bg-white overflow-hidden pb-2 border-bottom",4,"ngIf"],["class","material m-0 mb-4",3,"rows","headerHeight","footerHeight","rowHeight","columnMode","limit","count","offset","externalSorting","externalPaging","loadingIndicator","sort","page",4,"ngIf"],[1,"pt-4","row","sticky-top","bg-white","overflow-hidden","pb-2","border-bottom"],[1,"row"],[1,"col-9"],[1,"col-3","text-end"],[1,"me-2",3,"resourceName","filtersChange"],[1,"btn","btn-success",3,"routerLink"],[1,"bi","bi-plus-circle"],[1,"material","m-0","mb-4",3,"rows","headerHeight","footerHeight","rowHeight","columnMode","limit","count","offset","externalSorting","externalPaging","loadingIndicator","sort","page"],[3,"name","path","prop","draggable","resizeable","sortable","flexGrow",4,"ngFor","ngForOf"],[3,"name","draggable","resizeable","sortable","flexGrow"],["ngx-datatable-cell-template",""],[3,"name","path","prop","draggable","resizeable","sortable","flexGrow"],[4,"ngIf","ngIfThen","ngIfElse"],["thenBlock",""],["elseBlock",""],[1,"text-truncate","pr-2",3,"title"],[1,"text-end"],[1,"btn-group"],[1,"btn","btn-success","btn-sm",3,"routerLink"],[1,"bi","bi-pencil"],[1,"btn","btn-danger","btn-sm",3,"click"],[1,"bi","bi-trash"]],template:function(e,t){1&e&&(l.YNc(0,D,9,4,"div",0),l.YNc(1,P,4,17,"ngx-datatable",1)),2&e&&(l.Q6J("ngIf",t.resourceInfo),l.xp6(1),l.Q6J("ngIf",!t.loadingIndicator))},directives:[i.O5,T,c.yS,Q.nE,i.sg,Q.UC,Q.vq],styles:[""]}),e})();var z=s(6215),G=s(5796);function X(e,t){if(1&e&&(l.TgZ(0,"option",10),l._uU(1),l.qZA()),2&e){const e=t.$implicit;l.Q6J("value",e.key),l.xp6(1),l.Oqu(e.value)}}function K(e,t){if(1&e){const e=l.EpF();l.TgZ(0,"button",11),l.NdJ("click",function(){return l.CHM(e),l.oxw(2).preview()}),l._UZ(1,"i",12),l._uU(2," Preview "),l.qZA()}}function $(e,t){if(1&e){const e=l.EpF();l.TgZ(0,"button",11),l.NdJ("click",function(){return l.CHM(e),l.oxw(2).setPrices()}),l._UZ(1,"i",13),l._uU(2," Set Prices "),l.qZA()}}function W(e,t){if(1&e){const e=l.EpF();l.TgZ(0,"button",14),l.NdJ("click",function(){return l.CHM(e),l.oxw(2).submit()}),l._UZ(1,"i",15),l._uU(2," Save "),l.qZA()}if(2&e){const e=l.oxw(2);l.Q6J("disabled",!e.form.valid)}}function ee(e,t){if(1&e){const e=l.EpF();l.ynx(0),l.TgZ(1,"div",1),l.TgZ(2,"h2",2),l._uU(3),l.qZA(),l.TgZ(4,"div",3),l.TgZ(5,"select",4),l.YNc(6,X,2,2,"option",5),l.qZA(),l.YNc(7,K,3,0,"button",6),l.YNc(8,$,3,0,"button",6),l.YNc(9,W,3,1,"button",7),l.qZA(),l.qZA(),l.TgZ(10,"form",8),l.NdJ("ngSubmit",function(){return l.CHM(e),l.oxw().submit()}),l._UZ(11,"formly-form",9),l.qZA(),l.BQk()}if(2&e){const e=l.oxw();l.xp6(3),l.AsE("","create"===e.action?"Create":"Edit"," ",e.resourceInfo.label,""),l.xp6(2),l.Q6J("formControl",e.languageControl),l.xp6(1),l.Q6J("ngForOf",e.locales),l.xp6(1),l.Q6J("ngIf",e.isPriceList),l.xp6(1),l.Q6J("ngIf",e.isPriceList),l.xp6(1),l.Q6J("ngIf",e.form),l.xp6(1),l.Q6J("formGroup",e.form),l.xp6(1),l.Q6J("model",e.model)("fields",e.fields)("options",e.options)("form",e.form)}}let te=(()=>{class e{constructor(e,t,s,i,o,n,r){this.activatedRoute=e,this.router=t,this.formlyConfig=s,this.formService=i,this.alertsService=o,this.breadcrumbService=n,this.resourcesService=r,this.resourceName=null,this.resourceId=null,this.resourceInfo=null,this.form=new h.cw({}),this.languageControl=new h.NI(""),this.options={},this.model={},this.fields=[],this.language="en",this.locales=[],this.defaultLocale="nl"}ngOnInit(){this.activatedRoute.paramMap.subscribe(e=>{this.resourceName=e.get("name"),this.resourceId=e.get("id"),this.loadData()}),this.languageControl.valueChanges.subscribe(e=>{e&&this.fields&&(this.fields=this.mapFields(this.fields,e))})}get isPriceList(){return"priceList"===this.resourceName}loadData(){this.resourceName&&this.resourcesService.getResourceInfo(this.resourceName).subscribe(e=>{this.resourceInfo=e,this.initBreadcrumb(),this.resourceName&&(this.resourceId?this.resourcesService.getEditResourceSchema(this.resourceName,this.resourceId).subscribe(e=>{this.locales=this.mapLocales(e.locales),this.defaultLocale=e.defaultLocale,this.languageControl.setValue(this.defaultLocale),this.model=e.data,this.fields=this.mapFields(e.schema,this.languageControl.value)}):this.resourcesService.getCreateResourceSchema(this.resourceName).subscribe(e=>{this.locales=this.mapLocales(e.locales),this.defaultLocale=e.defaultLocale,this.languageControl.setValue(this.defaultLocale),this.model={},this.fields=this.mapFields(e.schema,this.languageControl.value)}))})}mapLocales(e){const t=[];for(const s in e)t.push({key:s,value:e[s]});return t}get action(){return this.resourceId?"edit":"create"}mapFields(e,t){return e.map(e=>{var s,i;return e.hasOwnProperty("fieldGroup")?e.fieldGroup=this.mapFields(e.fieldGroup,t):"repeat"===e.type&&(e.fieldArray.fieldGroup=this.mapFields(e.fieldArray.fieldGroup,t)),!0===(null===(s=null==e?void 0:e.templateOptions)||void 0===s?void 0:s.translatable)&&((null===(i=e.templateOptions)||void 0===i?void 0:i.language)?e.templateOptions.language.next(t):e.templateOptions.language=new z.X(t),e.wrappers=[...e.wrappers||[],"translatable"]),e.templateOptions.defaultLocale=this.defaultLocale,e})}submit(){this.form&&this.form.valid&&this.resourceName&&(this.resourceId?this.resourcesService.updateResource(this.resourceName,this.resourceId,this.model).subscribe(e=>{this.alertsService.show(n.NK.success,"Resource updated!")}):this.resourcesService.createResource(this.resourceName,this.model).subscribe(e=>{this.router.navigate(["/resources",this.resourceName,e.data._id,"edit"]),this.alertsService.show(n.NK.success,"Resource created!")}))}setPrices(){this.router.navigate(["/price-assign",this.resourceId])}preview(){this.router.navigate(["/price-assign/preview",this.resourceId])}initBreadcrumb(){var e,t;this.breadcrumbService.setBreadcrumb([{label:"Home",path:["/dashboard"]},{label:(null===(e=this.resourceInfo)||void 0===e?void 0:e.pluralLabel)||"Resource",path:[`/resources/${this.resourceName}`]},{label:"Edit "+(null===(t=this.resourceInfo)||void 0===t?void 0:t.label)||0,path:[`/resources/${this.resourceName}`]}]),this.breadcrumbService.update()}}return e.\u0275fac=function(t){return new(t||e)(l.Y36(c.gz),l.Y36(c.F0),l.Y36(S.o),l.Y36(G.w1X),l.Y36(n.ml),l.Y36(u.p),l.Y36(o.z6))},e.\u0275cmp=l.Xpm({type:e,selectors:[["app-edit"]],decls:1,vars:1,consts:[[4,"ngIf"],[1,"pt-4","row","sticky-top","bg-white","overflow-hidden","border-bottom","pb-2"],[1,"col-6","mb-0"],[1,"col-6","text-end","row","g-3","m-0"],[1,"form-select","col","me-2","mt-0",3,"formControl"],[3,"value",4,"ngFor","ngForOf"],["type","button","class","btn btn-primary submit-button me-2 col mt-0",3,"click",4,"ngIf"],["type","button","class","btn btn-primary submit-button col mt-0",3,"disabled","click",4,"ngIf"],[1,"mt-2",3,"formGroup","ngSubmit"],[3,"model","fields","options","form"],[3,"value"],["type","button",1,"btn","btn-primary","submit-button","me-2","col","mt-0",3,"click"],[1,"bi","bi-eye"],[1,"bi","bi-currency-euro"],["type","button",1,"btn","btn-primary","submit-button","col","mt-0",3,"disabled","click"],[1,"bi","bi-save"]],template:function(e,t){1&e&&l.YNc(0,ee,12,12,"ng-container",0),2&e&&l.Q6J("ngIf",t.form&&t.fields&&t.resourceInfo)},directives:[i.O5,h.EJ,h.JJ,h.oH,i.sg,h._Y,h.JL,h.sg,S.T7,h.YN,h.Kr],styles:[""]}),e})();var se=s(6715),ie=s(2114),oe=s(6661),ne=s(4463),re=s(3425),ae=s(453),le=s(6858);function ce(e,t){if(1&e&&l._UZ(0,"textarea",2),2&e){const e=l.oxw();l.ekj("is-invalid",e.showError),l.Q6J("formControl",e.valueControl)("cols",e.to.cols)("rows",e.to.rows)("formlyAttributes",e.field)}}function ue(e,t){if(1&e&&l._UZ(0,"quill-editor",3),2&e){const e=l.oxw();l.Q6J("formControl",e.valueControl)}}let de=(()=>{class e extends S.fS{constructor(){super(...arguments),this.defaultOptions={templateOptions:{cols:1,rows:1}},this.valueControl=new h.NI(""),this.language=""}ngOnInit(){var e,t;const s=[];this.valueControl&&(this.to.required&&s.push(h.kI.required),this.to.max&&s.push(h.kI.max(this.to.max)),this.to.maxLength&&s.push(h.kI.maxLength(this.to.maxLength)),this.to.min&&s.push(h.kI.min(this.to.min)),this.to.minLength&&s.push(h.kI.minLength(this.to.minLength)),this.to.pattern&&s.push(h.kI.pattern(this.to.pattern)),this.valueControl.setValidators(s)),(null===(e=this.to)||void 0===e?void 0:e.translatable)&&(null===(t=this.to)||void 0===t?void 0:t.language)?this.to.language.subscribe(e=>{if(e){this.language=e;const t=this.formControl.value&&"object"==typeof this.formControl.value&&!Array.isArray(this.formControl.value)?this.formControl.value[e]:"";this.valueControl.setValue(t)}}):this.valueControl.setValue(this.formControl.value||""),this.valueControl.valueChanges.subscribe(e=>{if(setTimeout(()=>this.formControl.setErrors(this.valueControl.errors)),this.formControl.markAsTouched(),this.to.translatable&&this.language){let t=this.formControl.value&&"object"==typeof this.formControl.value&&!Array.isArray(this.formControl.value)?this.formControl.value:{};t[this.language]=e,this.formControl.setValue(t)}else this.formControl.setValue(e)})}}return e.\u0275fac=function(){let t;return function(s){return(t||(t=l.n5z(e)))(s||e)}}(),e.\u0275cmp=l.Xpm({type:e,selectors:[["app-textarea"]],features:[l.qOj],decls:2,vars:2,consts:[["class","form-control",3,"formControl","cols","rows","is-invalid","formlyAttributes",4,"ngIf"],[3,"formControl",4,"ngIf"],[1,"form-control",3,"formControl","cols","rows","formlyAttributes"],[3,"formControl"]],template:function(e,t){1&e&&(l.YNc(0,ce,1,6,"textarea",0),l.YNc(1,ue,1,1,"quill-editor",1)),2&e&&(l.Q6J("ngIf",!(null!=t.to&&t.to.html)),l.xp6(1),l.Q6J("ngIf",null==t.to?null:t.to.html))},directives:[i.O5,h.Fj,h.JJ,h.oH,S.VQ,le.g6],styles:[""],changeDetection:0}),e})();var he=s(8366);function pe(e,t){1&e&&(l.TgZ(0,"span"),l._uU(1,"*"),l.qZA())}function me(e,t){if(1&e&&(l.TgZ(0,"label"),l._uU(1),l.YNc(2,pe,2,0,"span",1),l.qZA()),2&e){const e=l.oxw();l.uIk("for",e.id),l.xp6(1),l.hij(" ",e.to.label," "),l.xp6(1),l.Q6J("ngIf",e.to.required&&!0!==e.to.hideRequiredMarker)}}function fe(e,t){}function ge(e,t){if(1&e&&(l.TgZ(0,"button",8),l._UZ(1,"i",9),l.qZA()),2&e){l.oxw();const e=l.MAs(9);l.Q6J("adaptivePosition",!0)("popover",e)}}function be(e,t){if(1&e&&(l.TgZ(0,"div",10),l._UZ(1,"formly-validation-message",11),l.qZA()),2&e){const e=l.oxw();l.Udp("display","block"),l.xp6(1),l.Q6J("field",e.field)}}function ve(e,t){if(1&e&&(l.TgZ(0,"small",12),l._uU(1),l.qZA()),2&e){const e=l.oxw();l.xp6(1),l.Oqu(e.to.description)}}function we(e,t){if(1&e&&l._UZ(0,"img",14),2&e){const e=l.oxw(2);l.Q6J("src",e.getImg(),l.LSH)}}function _e(e,t){if(1&e&&l.YNc(0,we,1,1,"img",13),2&e){const e=l.oxw();l.Q6J("ngIf",e.getImg())}}let Ce=(()=>{class e extends S.n2{ngOnInit(){}getImg(){var e;if(this.formControl.value){const t=((null===(e=this.field.templateOptions)||void 0===e?void 0:e.options)||[]).find(e=>e.value===this.formControl.value);return null==t?void 0:t.img}}}return e.\u0275fac=function(){let t;return function(s){return(t||(t=l.n5z(e)))(s||e)}}(),e.\u0275cmp=l.Xpm({type:e,selectors:[["app-dropdown-wrapper"]],features:[l.qOj],decls:10,vars:6,consts:[[1,"form-group"],[4,"ngIf"],[1,"input-group"],["fieldComponent",""],["class","btn btn-outline-secondary","type","button","triggers","focus","container","body","placement","auto","title","Preview",3,"adaptivePosition","popover",4,"ngIf"],["class","invalid-feedback",3,"display",4,"ngIf"],["class","form-text text-muted",4,"ngIf"],["popTemplate",""],["type","button","triggers","focus","container","body","placement","auto","title","Preview",1,"btn","btn-outline-secondary",3,"adaptivePosition","popover"],[1,"bi","bi-eye"],[1,"invalid-feedback"],[3,"field"],[1,"form-text","text-muted"],["class","d-block w-100",3,"src",4,"ngIf"],[1,"d-block","w-100",3,"src"]],template:function(e,t){1&e&&(l.TgZ(0,"div",0),l.YNc(1,me,3,3,"label",1),l.TgZ(2,"div",2),l.YNc(3,fe,0,0,"ng-template",null,3,l.W1O),l.YNc(5,ge,2,2,"button",4),l.qZA(),l.YNc(6,be,2,3,"div",5),l.YNc(7,ve,2,1,"small",6),l.qZA(),l.YNc(8,_e,1,1,"ng-template",null,7,l.W1O)),2&e&&(l.ekj("has-error",t.showError),l.xp6(1),l.Q6J("ngIf",t.to.label&&!0!==t.to.hideLabel),l.xp6(4),l.Q6J("ngIf",t.getImg()),l.xp6(1),l.Q6J("ngIf",t.showError),l.xp6(1),l.Q6J("ngIf",t.to.description))},directives:[i.O5,he.k5,S.u_],styles:[".popover{max-width:600px!important}"]}),e})();function ye(e,t){1&e&&(l.TgZ(0,"span"),l._uU(1,"*"),l.qZA())}function xe(e,t){if(1&e&&(l.TgZ(0,"span",8),l._uU(1),l.qZA()),2&e){const e=l.oxw(2);l.xp6(1),l.hij(" ",e.language.toUpperCase()," ")}}function Ie(e,t){if(1&e&&(l.TgZ(0,"label",5),l._uU(1),l.YNc(2,ye,2,0,"span",6),l.YNc(3,xe,2,1,"span",7),l.qZA()),2&e){const e=l.oxw();l.uIk("for",e.id),l.xp6(1),l.hij(" ",e.to.label," "),l.xp6(1),l.Q6J("ngIf",e.to.required&&!0!==e.to.hideRequiredMarker),l.xp6(1),l.Q6J("ngIf",(null==e.to?null:e.to.translatable)&&e.language)}}function Ne(e,t){}function Ze(e,t){if(1&e&&(l.TgZ(0,"div",9),l._UZ(1,"formly-validation-message",10),l.qZA()),2&e){const e=l.oxw();l.Udp("display","block"),l.xp6(1),l.Q6J("field",e.field)}}function ke(e,t){if(1&e&&(l.TgZ(0,"small",11),l._uU(1),l.qZA()),2&e){const e=l.oxw();l.xp6(1),l.Oqu(e.to.description)}}let Ae=(()=>{class e extends S.n2{constructor(){super(...arguments),this.language=""}ngOnInit(){var e,t;(null===(e=this.to)||void 0===e?void 0:e.translatable)&&(null===(t=this.to)||void 0===t?void 0:t.language)&&this.to.language.subscribe(e=>{e&&(this.language=e)})}}return e.\u0275fac=function(){let t;return function(s){return(t||(t=l.n5z(e)))(s||e)}}(),e.\u0275cmp=l.Xpm({type:e,selectors:[["app-translatable"]],features:[l.qOj],decls:6,vars:5,consts:[[1,"form-group"],["class","w-100 mt-1",4,"ngIf"],["fieldComponent",""],["class","invalid-feedback",3,"display",4,"ngIf"],["class","form-text text-muted",4,"ngIf"],[1,"w-100","mt-1"],[4,"ngIf"],["class","language badge bg-secondary ms-2 float-end",4,"ngIf"],[1,"language","badge","bg-secondary","ms-2","float-end"],[1,"invalid-feedback"],[3,"field"],[1,"form-text","text-muted"]],template:function(e,t){1&e&&(l.TgZ(0,"div",0),l.YNc(1,Ie,4,4,"label",1),l.YNc(2,Ne,0,0,"ng-template",null,2,l.W1O),l.YNc(4,Ze,2,3,"div",3),l.YNc(5,ke,2,1,"small",4),l.qZA()),2&e&&(l.ekj("has-error",t.showError),l.xp6(1),l.Q6J("ngIf",t.to.label&&!0!==t.to.hideLabel),l.xp6(3),l.Q6J("ngIf",t.showError),l.xp6(1),l.Q6J("ngIf",t.to.description))},directives:[i.O5,S.u_],styles:[""]}),e})();function Oe(e,t){if(1&e&&l._UZ(0,"input",2),2&e){const e=l.oxw();l.ekj("is-invalid",e.showError),l.Q6J("type",e.type)("formControl",e.valueControl)("formlyAttributes",e.field)}}function Se(e,t){if(1&e&&l._UZ(0,"input",3),2&e){const e=l.oxw();l.ekj("is-invalid",e.showError),l.Q6J("formControl",e.valueControl)("formlyAttributes",e.field)}}let Ye=(()=>{class e extends S.fS{constructor(){super(),this.valueControl=new h.NI(""),this.language=""}ngOnInit(){var e,t;const s=[];this.valueControl&&(this.to.required&&s.push(h.kI.required),this.to.max&&s.push(h.kI.max(this.to.max)),this.to.maxLength&&s.push(h.kI.maxLength(this.to.maxLength)),this.to.min&&s.push(h.kI.min(this.to.min)),this.to.minLength&&s.push(h.kI.minLength(this.to.minLength)),this.to.pattern&&s.push(h.kI.pattern(this.to.pattern)),this.valueControl.setValidators(s)),(null===(e=this.to)||void 0===e?void 0:e.translatable)&&(null===(t=this.to)||void 0===t?void 0:t.language)?this.to.language.subscribe(e=>{if(e){this.language=e;const t=this.formControl.value&&"object"==typeof this.formControl.value&&!Array.isArray(this.formControl.value)?this.formControl.value[e]:"";this.valueControl.setValue(t)}}):this.valueControl.setValue(this.formControl.value||""),this.valueControl.valueChanges.subscribe(e=>{if(setTimeout(()=>this.formControl.setErrors(this.valueControl.errors)),this.formControl.markAsTouched(),this.to.translatable&&this.language){let t=this.formControl.value&&"object"==typeof this.formControl.value&&!Array.isArray(this.formControl.value)?this.formControl.value:{};t[this.language]=e,this.formControl.setValue(t)}else this.formControl.setValue(e)})}get type(){return this.to.type||"text"}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275cmp=l.Xpm({type:e,selectors:[["app-input"]],features:[l.qOj],decls:3,vars:2,consts:[["class","form-control",3,"type","formControl","formlyAttributes","is-invalid",4,"ngIf","ngIfElse"],["numberTmp",""],[1,"form-control",3,"type","formControl","formlyAttributes"],["type","number",1,"form-control",3,"formControl","formlyAttributes"]],template:function(e,t){if(1&e&&(l.YNc(0,Oe,1,5,"input",0),l.YNc(1,Se,1,4,"ng-template",null,1,l.W1O)),2&e){const e=l.MAs(2);l.Q6J("ngIf","number"!==t.type)("ngIfElse",e)}},directives:[i.O5,h.Fj,h.JJ,h.oH,S.VQ,h.wV],styles:[""]}),e})();const qe=[{path:":name",component:V},{path:":name/create",component:te},{path:":name/:id/edit",component:te}];let Je=(()=>{class e{}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=l.oAB({type:e}),e.\u0275inj=l.cJS({imports:[[i.ez,Q.xD,c.Bz.forChild(qe),ae.f.forRoot(),O.forRoot(),se.z$,h.UX,S.X0.forChild({extras:{lazyRender:!0},wrappers:[{name:"translatable",component:Ae},{name:"panel",component:ie.Z},{name:"layout",component:Ce}],types:[{name:"images",component:oe.Pw,wrappers:["form-field"]},{name:"repeat",component:ne.$},{name:"hasMany",component:re.a},{name:"textarea",component:de},{name:"input",component:Ye}]})]]}),e})()}}]);