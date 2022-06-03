<html>
<head>
    <title>{{translateFromPath($resourceData, 'name', 'Price List')}}</title>
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <script src="{{ asset('js/paged.polyfill.js') }}"></script>
    <script>
        class RepeatingTableHeaders extends Paged.Handler {

            constructor(chunker, polisher, caller) {
                super(chunker, polisher, caller);
                this.splitTablesRefs = [];
            }

            afterPageLayout(pageElement, page, breakToken, chunker) {
                this.chunker = chunker;
                this.splitTablesRefs = [];

                if (breakToken) {
                    const node = breakToken.node;
                    const tables = this.findAllAncestors(node, "table");

                    if (tables.length > 0) {
                        this.splitTablesRefs = tables.map(t => t.dataset.ref);

                        //checks if split inside thead and if so, set breakToken to next sibling element
                        let thead = node.tagName === "THEAD" ? node : this.findFirstAncestor(node, "thead");
                        if (thead) {
                            breakToken.node = this.nodeAfter(thead, chunker.source);
                        }

                        this.hideEmptyTables(pageElement);
                    }
                }
            }

            hideEmptyTables(pageElement) {
                this.splitTablesRefs.forEach(ref => {
                    let table = pageElement.querySelector("[data-ref='" + ref + "']");
                    let sourceBody = table.querySelectorAll("tbody tr");
                    const firstChild = sourceBody[0];
                    const lastChild = sourceBody[sourceBody.length - 1];

                    if (!firstChild) {
                        table.style.visibility = "hidden";
                        table.style.position = "absolute";
                        let lineSpacer = table.nextSibling;
                        if (lineSpacer) {
                            lineSpacer.style.visibility = "hidden";
                            lineSpacer.style.position = "absolute";
                        }
                    }

                    if (firstChild && this.emptyRow(firstChild)) {
                        firstChild.style.visibility = "hidden";
                        firstChild.style.display = "none";
                    }

                    if (lastChild && this.emptyRow(lastChild)) {
                        lastChild.style.visibility = "hidden";
                        lastChild.style.display = "none";
                    }

                });
            }

            emptyRow(tr) {
                let allTdsEmpty = true;
                tr.querySelectorAll("td").forEach((td) => {
                    if (td.innerHTML.trim().length > 0 || td.querySelector('img')) {
                        allTdsEmpty = false;
                    }
                });
                return allTdsEmpty;
            }

            findFirstAncestor(element, selector) {
                while (element.parentNode && element.parentNode.nodeType === 1) {
                    if (element.parentNode.matches(selector)) {
                        return element.parentNode;
                    }
                    element = element.parentNode;
                }
                return null;
            }

            findAllAncestors(element, selector) {
                const ancestors = [];
                while (element.parentNode && element.parentNode.nodeType === 1) {
                    if (element.parentNode.matches(selector)) {
                        ancestors.unshift(element.parentNode);
                    }
                    element = element.parentNode;
                }
                return ancestors;
            }

            // The addition of repeating Table Headers is done here because this hook is triggered before overflow handling
            layout(rendered, layout) {
                this.splitTablesRefs.forEach(ref => {
                    const renderedTable = rendered.querySelector("[data-ref='" + ref + "']");

                    // this event can be triggered multiple times
                    // added a flag repeated-headers to control when table headers already repeated in current page.
                    if (!renderedTable.getAttribute("repeated-headers")) {
                        // const sourceTable = this.chunker.source.querySelector("[data-ref='" + ref + "']");
                        // this.repeatColgroup(sourceTable, renderedTable);
                        // this.repeatTHead(sourceTable, renderedTable);
                        // renderedTable.setAttribute("repeated-headers", true);
                    }
                });
            }

            repeatColgroup(sourceTable, renderedTable) {
                let colgroup = sourceTable.querySelectorAll("colgroup");
                let firstChild = renderedTable.firstChild;
                colgroup.forEach((colgroup) => {
                    if (colgroup) {
                        let clonedColgroup = colgroup.cloneNode(true);
                        renderedTable.insertBefore(clonedColgroup, firstChild);
                    }
                });
            }

            repeatTHead(sourceTable, renderedTable) {
                let thead = sourceTable.querySelector("thead");
                if (thead) {
                    let clonedThead = thead.cloneNode(true);
                    renderedTable.insertBefore(clonedThead, renderedTable.firstChild);
                }
            }

            // copied this from pagedjs
            nodeAfter(node, limiter) {
                if (limiter && node === limiter) {
                    return;
                }
                let significantNode = this.nextSignificantNode(node);
                if (significantNode) {
                    return significantNode;
                }
                if (node.parentNode) {
                    while ((node = node.parentNode)) {
                        if (limiter && node === limiter) {
                            return;
                        }
                        significantNode = this.nextSignificantNode(node);
                        if (significantNode) {
                            return significantNode;
                        }
                    }
                }
            }

            nextSignificantNode(sib) {
                while ((sib = sib.nextSibling)) {
                    if (!this.isIgnorable(sib)) return sib;
                }
                return null;
            }

            isIgnorable(node) {
                return (node.nodeType === 8) || // A comment node
                    ((node.nodeType === 3) && this.isAllWhitespace(node)); // a text node, all whitespace
            }

            isAllWhitespace(node) {
                return !(/[^\t\n\r ]/.test(node.textContent));
            }

        }
        Paged.registerHandlers(RepeatingTableHeaders);
        //////////////////////////////////////////////////////////////
        class RepeatingAnyHeaders extends Paged.Handler {

            constructor(chunker, polisher, caller) {
                super(chunker, polisher, caller);
                this.splitTablesRefs = [];
            }

            afterPageLayout(pageElement, page, breakToken, chunker) {
                this.chunker = chunker;
                this.splitTablesRefs = [];

                if (breakToken) {
                    const node = breakToken.node;
                    const tables = this.findAllAncestors(node, ".repeating-container");

                    if (tables.length > 0) {
                        this.splitTablesRefs = tables.map(t => t.dataset.ref);

                        //checks if split inside thead and if so, set breakToken to next sibling element
                        let hasClassName = false;
                        if (node.className) {
                            hasClassName = node.className.split(" ").indexOf("repeating-header") > -1;
                        }
                        let thead = hasClassName ? node : this.findFirstAncestor(node, ".repeating-header");
                        if (thead) {
                            breakToken.node = this.nodeAfter(thead, chunker.source);
                        }

                        this.hideEmptyTables(pageElement);
                    }
                }
            }

            hideEmptyTables(pageElement) {
                this.splitTablesRefs.forEach(ref => {
                    let table = pageElement.querySelector("[data-ref='" + ref + "']");
                    let sourceBody = table.querySelector(".repeating-container-body");
                    if (!sourceBody || (sourceBody.textContent.trim() === '' && !sourceBody.querySelector('img'))) {
                        table.style.visibility = "hidden";
                        table.style.position = "absolute";
                        let lineSpacer = table.nextSibling;
                        if (lineSpacer) {
                            lineSpacer.style.visibility = "hidden";
                            lineSpacer.style.position = "absolute";
                        }
                    }
                });
            }

            findFirstAncestor(element, selector) {
                while (element.parentNode && element.parentNode.nodeType === 1) {
                    if (element.parentNode.matches(selector)) {
                        return element.parentNode;
                    }
                    element = element.parentNode;
                }
                return null;
            }

            findAllAncestors(element, selector) {
                const ancestors = [];
                while (element.parentNode && element.parentNode.nodeType === 1) {
                    if (element.parentNode.matches(selector)) {
                        ancestors.unshift(element.parentNode);
                    }
                    element = element.parentNode;
                }
                return ancestors;
            }

            // The addition of repeating Table Headers is done here because this hook is triggered before overflow handling
            layout(rendered, layout) {
                this.splitTablesRefs.forEach(ref => {
                    const renderedTable = rendered.querySelector("[data-ref='" + ref + "']");

                    // this event can be triggered multiple times
                    // added a flag repeated-headers to control when table headers already repeated in current page.
                    if (!renderedTable.getAttribute("repeated-headers")) {
                        const sourceTable = this.chunker.source.querySelector("[data-ref='" + ref + "']");
                        this.repeatColgroup(sourceTable, renderedTable);
                        this.repeatTHead(sourceTable, renderedTable);
                        renderedTable.setAttribute("repeated-headers", true);
                    }
                });
            }

            repeatColgroup(sourceTable, renderedTable) {
                let colgroup = sourceTable.querySelectorAll("colgroup");
                let firstChild = renderedTable.firstChild;
                colgroup.forEach((colgroup) => {
                    if (colgroup) {
                        let clonedColgroup = colgroup.cloneNode(true);
                        renderedTable.insertBefore(clonedColgroup, firstChild);
                    }
                });
            }

            repeatTHead(sourceTable, renderedTable) {
                let thead = sourceTable.querySelector(".repeating-header");
                if (thead) {
                    let clonedThead = thead.cloneNode(true);
                    renderedTable.insertBefore(clonedThead, renderedTable.firstChild);
                }
            }

            // copied this from pagedjs
            nodeAfter(node, limiter) {
                if (limiter && node === limiter) {
                    return;
                }
                let significantNode = this.nextSignificantNode(node);
                if (significantNode) {
                    return significantNode;
                }
                if (node.parentNode) {
                    while ((node = node.parentNode)) {
                        if (limiter && node === limiter) {
                            return;
                        }
                        significantNode = this.nextSignificantNode(node);
                        if (significantNode) {
                            return significantNode;
                        }
                    }
                }
            }

            nextSignificantNode(sib) {
                while ((sib = sib.nextSibling)) {
                    if (!this.isIgnorable(sib)) return sib;
                }
                return null;
            }

            isIgnorable(node) {
                return (node.nodeType === 8) || // A comment node
                    ((node.nodeType === 3) && this.isAllWhitespace(node)); // a text node, all whitespace
            }

            isAllWhitespace(node) {
                return !(/[^\t\n\r ]/.test(node.textContent));
            }

        }
        Paged.registerHandlers(RepeatingAnyHeaders);
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('styles')
</head>
<body>
    @yield('content')
</body>
</html>
