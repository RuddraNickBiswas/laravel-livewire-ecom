(() => {
    function h(i, e, t, a) {
        return {
            items: [],
            activeKey: null,
            orderedKeys: [],
            activatedByKeyPress: !1,
            activateSelectedOrFirst: i.debounce(function () {
                a(!1);
            }),
            registerItem(s, n, r, _) {
                this.items.push({ key: s, el: n, value: r, disabled: _ }),
                    this.orderedKeys.push(s),
                    this.reorderKeys(),
                    this.activateSelectedOrFirst();
            },
            unregisterItem(s) {
                let n = this.items.findIndex((r) => r.key === s);
                n !== -1 && this.items.splice(n, 1),
                    (n = this.orderedKeys.indexOf(s)),
                    n !== -1 && this.orderedKeys.splice(n, 1),
                    this.reorderKeys(),
                    this.activateSelectedOrFirst();
            },
            getItemByKey(s) {
                return this.items.find((n) => n.key === s);
            },
            getItemByValue(s) {
                return this.items.find((n) => i.raw(n.value) === i.raw(s));
            },
            getItemByEl(s) {
                return this.items.find((n) => n.el === s);
            },
            getItemsByValues(s) {
                let n = s.map((_) => i.raw(_)),
                    r = this.items.filter((_) => n.includes(i.raw(_.value)));
                return (
                    (r = r.slice().sort((_, o) => {
                        let l = _.el.compareDocumentPosition(o.el);
                        return l & Node.DOCUMENT_POSITION_FOLLOWING
                            ? -1
                            : l & Node.DOCUMENT_POSITION_PRECEDING
                            ? 1
                            : 0;
                    })),
                    r
                );
            },
            getActiveItem() {
                if (!this.hasActive()) return null;
                let s = this.items.find((n) => n.key === this.activeKey);
                return s || this.deactivateKey(this.activeKey), s;
            },
            activateItem(s) {
                s && this.activateKey(s.key);
            },
            reorderKeys: i.debounce(function () {
                (this.orderedKeys = this.items.map((s) => s.key)),
                    (this.orderedKeys = this.orderedKeys
                        .slice()
                        .sort((s, n) => {
                            if (s === null || n === null) return 0;
                            let r = this.items.find((l) => l.key === s).el,
                                _ = this.items.find((l) => l.key === n).el,
                                o = r.compareDocumentPosition(_);
                            return o & Node.DOCUMENT_POSITION_FOLLOWING
                                ? -1
                                : o & Node.DOCUMENT_POSITION_PRECEDING
                                ? 1
                                : 0;
                        })),
                    this.orderedKeys.includes(this.activeKey) ||
                        this.deactivateKey(this.activeKey);
            }),
            activeEl() {
                if (this.activeKey)
                    return this.items.find((s) => s.key === this.activeKey).el;
            },
            isActiveEl(s) {
                let n = this.items.find((r) => r.el === s);
                return this.activeKey === n;
            },
            activateEl(s) {
                let n = this.items.find((r) => r.el === s);
                this.activateKey(n.key);
            },
            isDisabledEl(s) {
                return this.items.find((n) => n.el === s).disabled;
            },
            get isScrollingTo() {
                return this.scrollingCount > 0;
            },
            scrollingCount: 0,
            activateAndScrollToKey(s, n) {
                if (!this.getItemByKey(s)) return;
                this.scrollingCount++,
                    this.activateKey(s, n),
                    this.items
                        .find((_) => _.key === s)
                        .el.scrollIntoView({ block: "nearest" }),
                    setTimeout(() => {
                        this.scrollingCount--;
                    }, 25);
            },
            isDisabled(s) {
                let n = this.items.find((r) => r.key === s);
                return n ? n.disabled : !1;
            },
            get nonDisabledOrderedKeys() {
                return this.orderedKeys.filter((s) => !this.isDisabled(s));
            },
            hasActive() {
                return !!this.activeKey;
            },
            wasActivatedByKeyPress() {
                return this.activatedByKeyPress;
            },
            isActiveKey(s) {
                return this.activeKey === s;
            },
            activateKey(s, n = !1) {
                this.isDisabled(s) ||
                    ((this.activeKey = s), (this.activatedByKeyPress = n));
            },
            deactivateKey(s) {
                this.activeKey === s &&
                    ((this.activeKey = null), (this.activatedByKeyPress = !1));
            },
            deactivate() {
                this.activeKey &&
                    (this.isScrollingTo ||
                        ((this.activeKey = null),
                        (this.activatedByKeyPress = !1)));
            },
            nextKey() {
                if (!this.activeKey) return;
                let s = this.nonDisabledOrderedKeys.findIndex(
                    (n) => n === this.activeKey
                );
                return this.nonDisabledOrderedKeys[s + 1];
            },
            prevKey() {
                if (!this.activeKey) return;
                let s = this.nonDisabledOrderedKeys.findIndex(
                    (n) => n === this.activeKey
                );
                return this.nonDisabledOrderedKeys[s - 1];
            },
            firstKey() {
                return this.nonDisabledOrderedKeys[0];
            },
            lastKey() {
                return this.nonDisabledOrderedKeys[
                    this.nonDisabledOrderedKeys.length - 1
                ];
            },
            searchQuery: "",
            clearSearch: i.debounce(function () {
                this.searchQuery = "";
            }, 350),
            searchKey(s) {
                this.clearSearch(), (this.searchQuery += s);
                let n;
                for (let r in this.items)
                    if (
                        this.items[r].el.textContent
                            .trim()
                            .toLowerCase()
                            .startsWith(this.searchQuery)
                    ) {
                        n = this.items[r].key;
                        break;
                    }
                if (this.nonDisabledOrderedKeys.includes(n)) return n;
            },
            activateByKeyEvent(s, n = !1, r = () => !1, _ = () => {}, o) {
                let l, u;
                o(!0);
                let f = !0;
                switch (s.key) {
                    case ["ArrowDown", "ArrowRight"][t === "vertical" ? 0 : 1]:
                        if (
                            (s.preventDefault(),
                            s.stopPropagation(),
                            o(!1),
                            !r())
                        ) {
                            _();
                            break;
                        }
                        this.reorderKeys(),
                            (u = this.hasActive()),
                            (l = u ? this.nextKey() : this.firstKey());
                        break;
                    case ["ArrowUp", "ArrowLeft"][t === "vertical" ? 0 : 1]:
                        if (
                            (s.preventDefault(),
                            s.stopPropagation(),
                            o(!1),
                            !r())
                        ) {
                            _();
                            break;
                        }
                        this.reorderKeys(),
                            (u = this.hasActive()),
                            (l = u ? this.prevKey() : this.lastKey());
                        break;
                    case "Home":
                    case "PageUp":
                        s.preventDefault(),
                            s.stopPropagation(),
                            o(!1),
                            this.reorderKeys(),
                            (u = this.hasActive()),
                            (l = this.firstKey());
                        break;
                    case "End":
                    case "PageDown":
                        s.preventDefault(),
                            s.stopPropagation(),
                            o(!1),
                            this.reorderKeys(),
                            (u = this.hasActive()),
                            (l = this.lastKey());
                        break;
                    default:
                        (f = this.activatedByKeyPress),
                            n &&
                                s.key.length === 1 &&
                                (l = this.searchKey(s.key));
                        break;
                }
                l && this.activateAndScrollToKey(l, f);
            },
        };
    }
    function c(i, e, t, a) {
        let s = p(t, a);
        s.forEach((_) => (_._x_hiddenInput = !0)),
            s.forEach((_) => (_._x_ignore = !0));
        let n = e.children,
            r = [];
        for (let _ = 0; _ < n.length; _++) {
            let o = n[_];
            if (o._x_hiddenInput) r.push(o);
            else break;
        }
        i.mutateDom(() => {
            r.forEach((_) => _.remove()),
                s.reverse().forEach((_) => e.prepend(_));
        });
    }
    function p(i, e, t = []) {
        if (S(e)) for (let a in e) t = t.concat(p(`${i}[${a}]`, e[a]));
        else {
            let a = document.createElement("input");
            return (
                a.setAttribute("type", "hidden"),
                a.setAttribute("name", i),
                a.setAttribute("value", "" + e),
                [a]
            );
        }
        return t;
    }
    function S(i) {
        return typeof i == "object" && i !== null;
    }
    function b(i) {
        i
            .directive("combobox", (e, t, { evaluate: a }) => {
                t.value === "input"
                    ? D(e, i)
                    : t.value === "button"
                    ? I(e, i)
                    : t.value === "label"
                    ? N(e, i)
                    : t.value === "options"
                    ? T(e, i)
                    : t.value === "option"
                    ? P(e, i, t, a)
                    : K(e, i);
            })
            .before("bind"),
            i.magic("combobox", (e) => {
                let t = i.$data(e);
                return {
                    get value() {
                        return t.__value;
                    },
                    get isOpen() {
                        return t.__isOpen;
                    },
                    get isDisabled() {
                        return t.__isDisabled;
                    },
                    get activeOption() {
                        let a = t.__context?.getActiveItem();
                        return a && a.value;
                    },
                    get activeIndex() {
                        let a = t.__context?.getActiveItem();
                        return a
                            ? Object.values(i.raw(t.__context.items)).findIndex(
                                  (s) => i.raw(a) == i.raw(s)
                              )
                            : null;
                    },
                };
            }),
            i.magic("comboboxOption", (e) => {
                let t = i.$data(e),
                    a = i.findClosest(e, (s) => s.__optionKey);
                if (!a) throw "No x-combobox:option directive found...";
                return {
                    get isActive() {
                        return t.__context.isActiveKey(a.__optionKey);
                    },
                    get isSelected() {
                        return t.__isSelected(a);
                    },
                    get isDisabled() {
                        return t.__context.isDisabled(a.__optionKey);
                    },
                };
            });
    }
    function K(i, e) {
        e.bind(i, {
            "x-id"() {
                return [
                    "alpine-combobox-button",
                    "alpine-combobox-options",
                    "alpine-combobox-label",
                ];
            },
            "x-modelable": "__value",
            "x-data"() {
                return {
                    __ready: !1,
                    __value: null,
                    __isOpen: !1,
                    __context: void 0,
                    __isMultiple: void 0,
                    __isStatic: !1,
                    __isDisabled: void 0,
                    __displayValue: void 0,
                    __compareBy: null,
                    __inputName: null,
                    __isTyping: !1,
                    __hold: !1,
                    init() {
                        (this.__isMultiple = e.extractProp(i, "multiple", !1)),
                            (this.__isDisabled = e.extractProp(
                                i,
                                "disabled",
                                !1
                            )),
                            (this.__inputName = e.extractProp(i, "name", null)),
                            (this.__nullable = e.extractProp(
                                i,
                                "nullable",
                                !1
                            )),
                            (this.__compareBy = e.extractProp(i, "by")),
                            (this.__context = h(
                                e,
                                this.__isMultiple,
                                "vertical",
                                () => this.__activateSelectedOrFirst()
                            ));
                        let t = e.extractProp(
                            i,
                            "default-value",
                            this.__isMultiple ? [] : null
                        );
                        (this.__value = t),
                            queueMicrotask(() => {
                                e.effect(() => {
                                    this.__inputName &&
                                        c(
                                            e,
                                            this.$el,
                                            this.__inputName,
                                            this.__value
                                        );
                                });
                            });
                    },
                    __startTyping() {
                        this.__isTyping = !0;
                    },
                    __stopTyping() {
                        this.__isTyping = !1;
                    },
                    __resetInput() {
                        let t = this.$refs.__input;
                        if (!t) return;
                        let a = this.__getCurrentValue();
                        t.value = a;
                    },
                    __getCurrentValue() {
                        return !this.$refs.__input || !this.__value
                            ? ""
                            : this.__displayValue
                            ? this.__displayValue(this.__value)
                            : typeof this.__value == "string"
                            ? this.__value
                            : "";
                    },
                    __open() {
                        if (this.__isOpen) return;
                        this.__isOpen = !0;
                        let t = this.$refs.__input;
                        if (t) {
                            let s = t.value,
                                {
                                    selectionStart: n,
                                    selectionEnd: r,
                                    selectionDirection: _,
                                } = t;
                            (t.value = ""),
                                t.dispatchEvent(new Event("change")),
                                (t.value = s),
                                _ !== null
                                    ? t.setSelectionRange(n, r, _)
                                    : t.setSelectionRange(n, r);
                        }
                        ((s) =>
                            requestAnimationFrame(() =>
                                requestAnimationFrame(s)
                            ))(() => {
                            this.$refs.__input.focus({ preventScroll: !0 }),
                                this.__activateSelectedOrFirst();
                        });
                    },
                    __close() {
                        (this.__isOpen = !1), this.__context.deactivate();
                    },
                    __activateSelectedOrFirst(t = !0) {
                        if (
                            !this.__isOpen ||
                            (this.__context.hasActive() &&
                                this.__context.wasActivatedByKeyPress())
                        )
                            return;
                        let a;
                        if (this.__isMultiple) {
                            let n = this.__context.getItemsByValues(
                                this.__value
                            );
                            a = n.length ? n[0].value : null;
                        } else a = this.__value;
                        let s = null;
                        if (
                            (t && a && (s = this.__context.getItemByValue(a)),
                            s)
                        ) {
                            this.__context.activateAndScrollToKey(s.key);
                            return;
                        }
                        this.__context.activateAndScrollToKey(
                            this.__context.firstKey()
                        );
                    },
                    __selectActive() {
                        let t = this.__context.getActiveItem();
                        t && this.__toggleSelected(t.value);
                    },
                    __selectOption(t) {
                        let a = this.__context.getItemByEl(t);
                        a && this.__toggleSelected(a.value);
                    },
                    __isSelected(t) {
                        let a = this.__context.getItemByEl(t);
                        return !a || !a.value
                            ? !1
                            : this.__hasSelected(a.value);
                    },
                    __toggleSelected(t) {
                        if (!this.__isMultiple) {
                            this.__value = t;
                            return;
                        }
                        let a = this.__value.findIndex((s) =>
                            this.__compare(s, t)
                        );
                        a === -1
                            ? this.__value.push(t)
                            : this.__value.splice(a, 1);
                    },
                    __hasSelected(t) {
                        return this.__isMultiple
                            ? this.__value.some((a) => this.__compare(a, t))
                            : this.__compare(this.__value, t);
                    },
                    __compare(t, a) {
                        let s = this.__compareBy;
                        if (
                            (s || (s = (n, r) => e.raw(n) === e.raw(r)),
                            typeof s == "string")
                        ) {
                            let n = s;
                            s = (r, _) => r[n] === _[n];
                        }
                        return s(t, a);
                    },
                };
            },
            "@mousedown.window"(t) {
                !this.$refs.__input.contains(t.target) &&
                    !this.$refs.__button.contains(t.target) &&
                    !this.$refs.__options.contains(t.target) &&
                    (this.__close(), this.__resetInput());
            },
        });
    }
    function D(i, e) {
        e.bind(i, {
            "x-ref": "__input",
            ":id"() {
                return this.$id("alpine-combobox-input");
            },
            role: "combobox",
            tabindex: "0",
            "aria-autocomplete": "list",
            async ":aria-controls"() {
                return await $(
                    () => this.$refs.__options && this.$refs.__options.id
                );
            },
            ":aria-expanded"() {
                return this.$data.__isDisabled ? void 0 : this.$data.__isOpen;
            },
            ":aria-multiselectable"() {
                return this.$data.__isMultiple ? !0 : void 0;
            },
            ":aria-activedescendant"() {
                if (!this.$data.__context.hasActive()) return;
                let t = this.$data.__context.getActiveItem();
                return t ? t.el.id : null;
            },
            ":aria-labelledby"() {
                return this.$refs.__label
                    ? this.$refs.__label.id
                    : this.$refs.__button
                    ? this.$refs.__button.id
                    : null;
            },
            "x-init"() {
                let t = e.extractProp(this.$el, "display-value");
                t && (this.$data.__displayValue = t);
            },
            "@input.stop"(t) {
                this.$data.__isTyping &&
                    (this.$data.__open(), this.$dispatch("change"));
            },
            "@blur"() {
                this.$data.__stopTyping(!1);
            },
            "@keydown"(t) {
                queueMicrotask(() =>
                    this.$data.__context.activateByKeyEvent(
                        t,
                        !1,
                        () => this.$data.__isOpen,
                        () => this.$data.__open(),
                        (a) => (this.$data.__isTyping = a)
                    )
                );
            },
            "@keydown.enter.prevent.stop"() {
                this.$data.__selectActive(),
                    this.$data.__stopTyping(),
                    this.$data.__isMultiple ||
                        (this.$data.__close(), this.$data.__resetInput());
            },
            "@keydown.escape.prevent"(t) {
                this.$data.__static || t.stopPropagation(),
                    this.$data.__stopTyping(),
                    this.$data.__close(),
                    this.$data.__resetInput();
            },
            "@keydown.tab"() {
                this.$data.__stopTyping(),
                    this.$data.__isOpen && this.$data.__close(),
                    this.$data.__resetInput();
            },
            "@keydown.backspace"(t) {
                if (this.$data.__isMultiple || !this.$data.__nullable) return;
                let a = t.target;
                requestAnimationFrame(() => {
                    if (a.value === "") {
                        this.$data.__value = null;
                        let s = this.$refs.__options;
                        s && (s.scrollTop = 0),
                            this.$data.__context.deactivate();
                    }
                });
            },
        });
    }
    function I(i, e) {
        e.bind(i, {
            "x-ref": "__button",
            ":id"() {
                return this.$id("alpine-combobox-button");
            },
            "aria-haspopup": "true",
            async ":aria-controls"() {
                return await $(
                    () => this.$refs.__options && this.$refs.__options.id
                );
            },
            ":aria-labelledby"() {
                return this.$refs.__label
                    ? [this.$refs.__label.id, this.$el.id].join(" ")
                    : null;
            },
            ":aria-expanded"() {
                return this.$data.__isDisabled ? null : this.$data.__isOpen;
            },
            ":disabled"() {
                return this.$data.__isDisabled;
            },
            tabindex: "-1",
            "x-init"() {
                this.$el.tagName.toLowerCase() === "button" &&
                    !this.$el.hasAttribute("type") &&
                    (this.$el.type = "button");
            },
            "@click"(t) {
                this.$data.__isDisabled ||
                    (this.$data.__isOpen
                        ? (this.$data.__close(), this.$data.__resetInput())
                        : (t.preventDefault(), this.$data.__open()),
                    this.$nextTick(() =>
                        this.$refs.__input.focus({ preventScroll: !0 })
                    ));
            },
        });
    }
    function N(i, e) {
        e.bind(i, {
            "x-ref": "__label",
            ":id"() {
                return this.$id("alpine-combobox-label");
            },
            "@click"() {
                this.$refs.__input.focus({ preventScroll: !0 });
            },
        });
    }
    function T(i, e) {
        e.bind(i, {
            "x-ref": "__options",
            ":id"() {
                return this.$id("alpine-combobox-options");
            },
            role: "listbox",
            ":aria-labelledby"() {
                return this.$refs.__label
                    ? this.$refs.__label.id
                    : this.$refs.__button
                    ? this.$refs.__button.id
                    : null;
            },
            "x-init"() {
                (this.$data.__isStatic = e.bound(this.$el, "static", !1)),
                    e.bound(this.$el, "hold") && (this.$data.__hold = !0);
            },
            "x-show"() {
                return this.$data.__isStatic ? !0 : this.$data.__isOpen;
            },
        });
    }
    function P(i, e) {
        e.bind(i, {
            "x-id"() {
                return ["alpine-combobox-option"];
            },
            ":id"() {
                return this.$id("alpine-combobox-option");
            },
            role: "option",
            ":tabindex"() {
                return this.$comboboxOption.isDisabled ? void 0 : "-1";
            },
            "x-effect"() {
                this.$comboboxOption.isActive
                    ? i.setAttribute("aria-selected", !0)
                    : i.removeAttribute("aria-selected");
            },
            ":aria-disabled"() {
                return this.$comboboxOption.isDisabled;
            },
            "x-data"() {
                return {
                    init() {
                        let t = (this.$el.__optionKey = (Math.random() + 1)
                                .toString(36)
                                .substring(7)),
                            a = e.extractProp(this.$el, "value"),
                            s = e.extractProp(this.$el, "disabled", !1, !1);
                        this.__context.registerItem(t, this.$el, a, s);
                    },
                    destroy() {
                        this.__context.unregisterItem(this.$el.__optionKey);
                    },
                };
            },
            "@click"() {
                this.$comboboxOption.isDisabled ||
                    (this.__selectOption(this.$el),
                    this.__isMultiple || (this.__close(), this.__resetInput()),
                    this.$nextTick(() =>
                        this.$refs.__input.focus({ preventScroll: !0 })
                    ));
            },
            "@mouseenter"(t) {
                this.__context.activateEl(this.$el);
            },
            "@mousemove"(t) {
                this.__context.isActiveEl(this.$el) ||
                    this.__context.activateEl(this.$el);
            },
            "@mouseleave"(t) {
                this.__hold || this.__context.deactivate();
            },
        });
    }
    function $(i) {
        return new Promise((e) => queueMicrotask(() => e(i())));
    }
    function v(i) {
        i.directive("dialog", (e, t) => {
            t.value === "overlay"
                ? M(e, i)
                : t.value === "panel"
                ? B(e, i)
                : t.value === "title"
                ? V(e, i)
                : t.value === "description"
                ? L(e, i)
                : C(e, i);
        }),
            i.magic("dialog", (e) => {
                let t = i.$data(e);
                return {
                    get open() {
                        return t.__isOpen;
                    },
                    get isOpen() {
                        return t.__isOpen;
                    },
                    close() {
                        t.__close();
                    },
                };
            });
    }
    function C(i, e) {
        e.bind(i, {
            "x-data"() {
                return {
                    init() {
                        e.bound(i, "open") !== void 0 &&
                            e.effect(() => {
                                this.__isOpenState = e.bound(i, "open");
                            }),
                            e.bound(i, "initial-focus") !== void 0 &&
                                this.$watch("__isOpenState", () => {
                                    this.__isOpenState &&
                                        setTimeout(() => {
                                            e.bound(i, "initial-focus").focus();
                                        }, 0);
                                });
                    },
                    __isOpenState: !1,
                    __close() {
                        e.bound(i, "open")
                            ? this.$dispatch("close")
                            : (this.__isOpenState = !1);
                    },
                    get __isOpen() {
                        return e.bound(i, "static", this.__isOpenState);
                    },
                };
            },
            "x-modelable": "__isOpenState",
            "x-id"() {
                return ["alpine-dialog-title", "alpine-dialog-description"];
            },
            "x-show"() {
                return this.__isOpen;
            },
            "x-trap.inert.noscroll"() {
                return this.__isOpen;
            },
            "@keydown.escape"() {
                this.__close();
            },
            ":aria-labelledby"() {
                return this.$id("alpine-dialog-title");
            },
            ":aria-describedby"() {
                return this.$id("alpine-dialog-description");
            },
            role: "dialog",
            "aria-modal": "true",
        });
    }
    function M(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$data.__isOpen === void 0 &&
                    console.warn(
                        '"x-dialog:overlay" is missing a parent element with "x-dialog".'
                    );
            },
            "x-show"() {
                return this.__isOpen;
            },
            "@click.prevent.stop"() {
                this.$data.__close();
            },
        });
    }
    function B(i, e) {
        e.bind(i, {
            "@click.outside"() {
                this.$data.__close();
            },
            "x-show"() {
                return this.$data.__isOpen;
            },
        });
    }
    function V(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$data.__isOpen === void 0 &&
                    console.warn(
                        '"x-dialog:title" is missing a parent element with "x-dialog".'
                    );
            },
            ":id"() {
                return this.$id("alpine-dialog-title");
            },
        });
    }
    function L(i, e) {
        e.bind(i, {
            ":id"() {
                return this.$id("alpine-dialog-description");
            },
        });
    }
    function m(i) {
        i
            .directive("disclosure", (e, t) => {
                t.value
                    ? t.value === "panel"
                        ? q(e, i)
                        : t.value === "button" && R(e, i)
                    : F(e, i);
            })
            .before("bind"),
            i.magic("disclosure", (e) => {
                let t = i.$data(e);
                return {
                    get isOpen() {
                        return t.__isOpen;
                    },
                    close() {
                        t.__close();
                    },
                };
            });
    }
    function F(i, e) {
        e.bind(i, {
            "x-modelable": "__isOpen",
            "x-data"() {
                return {
                    init() {
                        queueMicrotask(() => {
                            let t = Boolean(
                                e.bound(this.$el, "default-open", !1)
                            );
                            t && (this.__isOpen = t);
                        });
                    },
                    __isOpen: !1,
                    __close() {
                        this.__isOpen = !1;
                    },
                    __toggle() {
                        this.__isOpen = !this.__isOpen;
                    },
                };
            },
            "x-id"() {
                return ["alpine-disclosure-panel"];
            },
        });
    }
    function R(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$el.tagName.toLowerCase() === "button" &&
                    !this.$el.hasAttribute("type") &&
                    (this.$el.type = "button");
            },
            "@click"() {
                this.$data.__isOpen = !this.$data.__isOpen;
            },
            ":aria-expanded"() {
                return this.$data.__isOpen;
            },
            ":aria-controls"() {
                return this.$data.$id("alpine-disclosure-panel");
            },
            "@keydown.space.prevent.stop"() {
                this.$data.__toggle();
            },
            "@keydown.enter.prevent.stop"() {
                this.$data.__toggle();
            },
            "@keyup.space.prevent"() {},
        });
    }
    function q(i, e) {
        e.bind(i, {
            "x-show"() {
                return this.$data.__isOpen;
            },
            ":id"() {
                return this.$data.$id("alpine-disclosure-panel");
            },
        });
    }
    function x(i) {
        i
            .directive("listbox", (e, t) => {
                t.value
                    ? t.value === "label"
                        ? W(e, i)
                        : t.value === "button"
                        ? U(e, i)
                        : t.value === "options"
                        ? Q(e, i)
                        : t.value === "option" && H(e, i)
                    : G(e, i);
            })
            .before("bind"),
            i.magic("listbox", (e) => {
                let t = i.$data(e);
                return {
                    get selected() {
                        return t.__value;
                    },
                    get active() {
                        let a = t.__context.getActiveItem();
                        return a && a.value;
                    },
                    get value() {
                        return t.__value;
                    },
                    get isOpen() {
                        return t.__isOpen;
                    },
                    get isDisabled() {
                        return t.__isDisabled;
                    },
                    get activeOption() {
                        let a = t.__context.getActiveItem();
                        return a && a.value;
                    },
                    get activeIndex() {
                        let a = t.__context.getActiveItem();
                        return a && a.key;
                    },
                };
            }),
            i.magic("listboxOption", (e) => {
                let t = i.$data(e),
                    a = i.findClosest(e, (s) => s.__optionKey);
                if (!a) throw "No x-combobox:option directive found...";
                return {
                    get isActive() {
                        return t.__context.isActiveKey(a.__optionKey);
                    },
                    get isSelected() {
                        return t.__isSelected(a);
                    },
                    get isDisabled() {
                        return t.__context.isDisabled(a.__optionKey);
                    },
                };
            });
    }
    function G(i, e) {
        e.bind(i, {
            "x-id"() {
                return [
                    "alpine-listbox-button",
                    "alpine-listbox-options",
                    "alpine-listbox-label",
                ];
            },
            "x-modelable": "__value",
            "x-data"() {
                return {
                    __ready: !1,
                    __value: null,
                    __isOpen: !1,
                    __context: void 0,
                    __isMultiple: void 0,
                    __isStatic: !1,
                    __isDisabled: void 0,
                    __compareBy: null,
                    __inputName: null,
                    __orientation: "vertical",
                    __hold: !1,
                    init() {
                        (this.__isMultiple = e.extractProp(i, "multiple", !1)),
                            (this.__isDisabled = e.extractProp(
                                i,
                                "disabled",
                                !1
                            )),
                            (this.__inputName = e.extractProp(i, "name", null)),
                            (this.__compareBy = e.extractProp(i, "by")),
                            (this.__orientation = e.extractProp(
                                i,
                                "horizontal",
                                !1
                            )
                                ? "horizontal"
                                : "vertical"),
                            (this.__context = h(
                                e,
                                this.__isMultiple,
                                this.__orientation,
                                () => this.$data.__activateSelectedOrFirst()
                            ));
                        let t = e.extractProp(
                            i,
                            "default-value",
                            this.__isMultiple ? [] : null
                        );
                        (this.__value = t),
                            queueMicrotask(() => {
                                e.effect(() => {
                                    this.__inputName &&
                                        c(
                                            e,
                                            this.$el,
                                            this.__inputName,
                                            this.__value
                                        );
                                }),
                                    e.effect(() => {
                                        this.__resetInput();
                                    });
                            });
                    },
                    __resetInput() {
                        let t = this.$refs.__input;
                        if (!t) return;
                        let a = this.$data.__getCurrentValue();
                        t.value = a;
                    },
                    __getCurrentValue() {
                        return !this.$refs.__input || !this.__value
                            ? ""
                            : this.$data.__displayValue &&
                              this.__value !== void 0
                            ? this.$data.__displayValue(this.__value)
                            : typeof this.__value == "string"
                            ? this.__value
                            : "";
                    },
                    __open() {
                        if (this.__isOpen) return;
                        (this.__isOpen = !0),
                            this.__activateSelectedOrFirst(),
                            ((a) =>
                                requestAnimationFrame(() =>
                                    requestAnimationFrame(a)
                                ))(() =>
                                this.$refs.__options.focus({
                                    preventScroll: !0,
                                })
                            );
                    },
                    __close() {
                        (this.__isOpen = !1),
                            this.__context.deactivate(),
                            this.$nextTick(() =>
                                this.$refs.__button.focus({ preventScroll: !0 })
                            );
                    },
                    __activateSelectedOrFirst(t = !0) {
                        if (!this.__isOpen) return;
                        if (this.__context.activeKey) {
                            this.__context.activateAndScrollToKey(
                                this.__context.activeKey
                            );
                            return;
                        }
                        let a;
                        if (
                            (this.__isMultiple
                                ? (a = this.__value.find(
                                      (s) => !!this.__context.getItemByValue(s)
                                  ))
                                : (a = this.__value),
                            t && a)
                        ) {
                            let s = this.__context.getItemByValue(a);
                            s && this.__context.activateAndScrollToKey(s.key);
                        } else
                            this.__context.activateAndScrollToKey(
                                this.__context.firstKey()
                            );
                    },
                    __selectActive() {
                        let t = this.$data.__context.getActiveItem();
                        t && this.__toggleSelected(t.value);
                    },
                    __selectOption(t) {
                        let a = this.__context.getItemByEl(t);
                        a && this.__toggleSelected(a.value);
                    },
                    __isSelected(t) {
                        let a = this.__context.getItemByEl(t);
                        return !a || !a.value
                            ? !1
                            : this.__hasSelected(a.value);
                    },
                    __toggleSelected(t) {
                        if (!this.__isMultiple) {
                            this.__value = t;
                            return;
                        }
                        let a = this.__value.findIndex((s) =>
                            this.__compare(s, t)
                        );
                        a === -1
                            ? this.__value.push(t)
                            : this.__value.splice(a, 1);
                    },
                    __hasSelected(t) {
                        return this.__isMultiple
                            ? this.__value.some((a) => this.__compare(a, t))
                            : this.__compare(this.__value, t);
                    },
                    __compare(t, a) {
                        let s = this.__compareBy;
                        if (
                            (s || (s = (n, r) => e.raw(n) === e.raw(r)),
                            typeof s == "string")
                        ) {
                            let n = s;
                            s = (r, _) => r[n] === _[n];
                        }
                        return s(t, a);
                    },
                };
            },
        });
    }
    function W(i, e) {
        e.bind(i, {
            "x-ref": "__label",
            ":id"() {
                return this.$id("alpine-listbox-label");
            },
            "@click"() {
                this.$refs.__button.focus({ preventScroll: !0 });
            },
        });
    }
    function U(i, e) {
        e.bind(i, {
            "x-ref": "__button",
            ":id"() {
                return this.$id("alpine-listbox-button");
            },
            "aria-haspopup": "true",
            ":aria-labelledby"() {
                return this.$id("alpine-listbox-label");
            },
            ":aria-expanded"() {
                return this.$data.__isOpen;
            },
            ":aria-controls"() {
                return (
                    this.$data.__isOpen && this.$id("alpine-listbox-options")
                );
            },
            "x-init"() {
                this.$el.tagName.toLowerCase() === "button" &&
                    !this.$el.hasAttribute("type") &&
                    (this.$el.type = "button");
            },
            "@click"() {
                this.$data.__open();
            },
            "@keydown"(t) {
                ["ArrowDown", "ArrowUp", "ArrowLeft", "ArrowRight"].includes(
                    t.key
                ) &&
                    (t.stopPropagation(),
                    t.preventDefault(),
                    this.$data.__open());
            },
            "@keydown.space.stop.prevent"() {
                this.$data.__open();
            },
            "@keydown.enter.stop.prevent"() {
                this.$data.__open();
            },
        });
    }
    function Q(i, e) {
        e.bind(i, {
            "x-ref": "__options",
            ":id"() {
                return this.$id("alpine-listbox-options");
            },
            role: "listbox",
            tabindex: "0",
            ":aria-orientation"() {
                return this.$data.__orientation;
            },
            ":aria-labelledby"() {
                return this.$id("alpine-listbox-button");
            },
            ":aria-activedescendant"() {
                if (!this.$data.__context.hasActive()) return;
                let t = this.$data.__context.getActiveItem();
                return t ? t.el.id : null;
            },
            "x-init"() {
                (this.$data.__isStatic = e.extractProp(this.$el, "static", !1)),
                    e.bound(this.$el, "hold") && (this.$data.__hold = !0);
            },
            "x-show"() {
                return this.$data.__isStatic ? !0 : this.$data.__isOpen;
            },
            "x-trap"() {
                return this.$data.__isOpen;
            },
            "@click.outside"() {
                this.$data.__close();
            },
            "@keydown.escape.stop.prevent"() {
                this.$data.__close();
            },
            "@focus"() {
                this.$data.__activateSelectedOrFirst();
            },
            "@keydown"(t) {
                queueMicrotask(() =>
                    this.$data.__context.activateByKeyEvent(
                        t,
                        !0,
                        () => this.$data.__isOpen,
                        () => this.$data.__open(),
                        () => {}
                    )
                );
            },
            "@keydown.enter.stop.prevent"() {
                this.$data.__selectActive(),
                    this.$data.__isMultiple || this.$data.__close();
            },
            "@keydown.space.stop.prevent"() {
                this.$data.__selectActive(),
                    this.$data.__isMultiple || this.$data.__close();
            },
        });
    }
    function H(i, e) {
        e.bind(i, () => ({
            "x-id"() {
                return ["alpine-listbox-option"];
            },
            ":id"() {
                return this.$id("alpine-listbox-option");
            },
            role: "option",
            ":tabindex"() {
                return this.$listboxOption.isDisabled ? !1 : "-1";
            },
            ":aria-selected"() {
                return this.$listboxOption.isSelected;
            },
            "x-data"() {
                return {
                    init() {
                        let t = (i.__optionKey = (Math.random() + 1)
                                .toString(36)
                                .substring(7)),
                            a = e.extractProp(i, "value"),
                            s = e.extractProp(i, "disabled", !1, !1);
                        this.$data.__context.registerItem(t, i, a, s);
                    },
                    destroy() {
                        this.$data.__context.unregisterItem(
                            this.$el.__optionKey
                        );
                    },
                };
            },
            "@click"() {
                this.$listboxOption.isDisabled ||
                    (this.$data.__selectOption(i),
                    this.$data.__isMultiple || this.$data.__close());
            },
            "@mouseenter"() {
                this.$data.__context.activateEl(i);
            },
            "@mouseleave"() {
                this.$data.__hold || this.$data.__context.deactivate();
            },
        }));
    }
    function y(i) {
        i.directive("popover", (e, t) => {
            t.value
                ? t.value === "overlay"
                    ? Y(e, i)
                    : t.value === "button"
                    ? z(e, i)
                    : t.value === "panel"
                    ? J(e, i)
                    : t.value === "group" && X(e, i)
                : j(e, i);
        }),
            i.magic("popover", (e) => {
                let t = i.$data(e);
                return {
                    get isOpen() {
                        return t.__isOpenState;
                    },
                    open() {
                        t.__open();
                    },
                    close() {
                        t.__close();
                    },
                };
            });
    }
    function j(i, e) {
        e.bind(i, {
            "x-id"() {
                return ["alpine-popover-button", "alpine-popover-panel"];
            },
            "x-modelable": "__isOpenState",
            "x-data"() {
                return {
                    init() {
                        this.$data.__groupEl &&
                            this.$data.__groupEl.addEventListener(
                                "__close-others",
                                ({ detail: t }) => {
                                    t.el.isSameNode(this.$el) ||
                                        this.__close(!1);
                                }
                            );
                    },
                    __buttonEl: void 0,
                    __panelEl: void 0,
                    __isStatic: !1,
                    get __isOpen() {
                        return this.__isStatic ? !0 : this.__isOpenState;
                    },
                    __isOpenState: !1,
                    __open() {
                        (this.__isOpenState = !0),
                            this.$dispatch("__close-others", { el: this.$el });
                    },
                    __toggle() {
                        this.__isOpenState ? this.__close() : this.__open();
                    },
                    __close(t) {
                        this.__isStatic ||
                            ((this.__isOpenState = !1),
                            t !== !1 &&
                                ((t = t || this.$data.__buttonEl),
                                !document.activeElement.isSameNode(t) &&
                                    setTimeout(() => t.focus())));
                    },
                    __contains(t, a) {
                        return !!e.findClosest(a, (s) => s.isSameNode(t));
                    },
                };
            },
            "@keydown.escape.stop.prevent"() {
                this.__close();
            },
            "@focusin.window"() {
                if (this.$data.__groupEl) {
                    this.$data.__contains(
                        this.$data.__groupEl,
                        document.activeElement
                    ) || this.$data.__close(!1);
                    return;
                }
                this.$data.__contains(this.$el, document.activeElement) ||
                    this.$data.__close(!1);
            },
        });
    }
    function z(i, e) {
        e.bind(i, {
            "x-ref": "button",
            ":id"() {
                return this.$id("alpine-popover-button");
            },
            ":aria-expanded"() {
                return this.$data.__isOpen;
            },
            ":aria-controls"() {
                return this.$data.__isOpen && this.$id("alpine-popover-panel");
            },
            "x-init"() {
                this.$el.tagName.toLowerCase() === "button" &&
                    !this.$el.hasAttribute("type") &&
                    (this.$el.type = "button"),
                    (this.$data.__buttonEl = this.$el);
            },
            "@click"() {
                this.$data.__toggle();
            },
            "@keydown.tab"(t) {
                if (!t.shiftKey && this.$data.__isOpen) {
                    let a = this.$focus.within(this.$data.__panelEl).getFirst();
                    a &&
                        (t.preventDefault(),
                        t.stopPropagation(),
                        this.$focus.focus(a));
                }
            },
            "@keyup.tab"(t) {
                if (this.$data.__isOpen) {
                    let a = this.$focus.previouslyFocused();
                    if (!a) return;
                    !this.$data.__buttonEl.contains(a) &&
                        !this.$data.__panelEl.contains(a) &&
                        a &&
                        this.$el.compareDocumentPosition(a) &
                            Node.DOCUMENT_POSITION_FOLLOWING &&
                        (t.preventDefault(),
                        t.stopPropagation(),
                        this.$focus.within(this.$data.__panelEl).last());
                }
            },
            "@keydown.space.stop.prevent"() {
                this.$data.__toggle();
            },
            "@keydown.enter.stop.prevent"() {
                this.$data.__toggle();
            },
            "@keyup.space.stop.prevent"() {},
        });
    }
    function J(i, e) {
        e.bind(i, {
            "x-init"() {
                (this.$data.__isStatic = e.bound(this.$el, "static", !1)),
                    (this.$data.__panelEl = this.$el);
            },
            "x-effect"() {
                this.$data.__isOpen &&
                    e.bound(i, "focus") &&
                    this.$focus.first();
            },
            "x-ref": "panel",
            ":id"() {
                return this.$id("alpine-popover-panel");
            },
            "x-show"() {
                return this.$data.__isOpen;
            },
            "@mousedown.window"(t) {
                this.$data.__isOpen &&
                    (this.$data.__contains(this.$data.__buttonEl, t.target) ||
                        this.$data.__contains(this.$el, t.target) ||
                        this.$focus.focusable(t.target) ||
                        this.$data.__close());
            },
            "@keydown.tab"(t) {
                if (t.shiftKey && this.$focus.isFirst(t.target))
                    t.preventDefault(),
                        t.stopPropagation(),
                        e.bound(i, "focus")
                            ? this.$data.__close()
                            : this.$data.__buttonEl.focus();
                else if (!t.shiftKey && this.$focus.isLast(t.target)) {
                    t.preventDefault(), t.stopPropagation();
                    let a = this.$focus.within(document).all(),
                        s = a.indexOf(this.$data.__buttonEl);
                    a
                        .splice(s + 1)
                        .filter((r) => !this.$el.contains(r))[0]
                        .focus(),
                        e.bound(i, "focus") && this.$data.__close(!1);
                }
            },
        });
    }
    function X(i, e) {
        e.bind(i, {
            "x-ref": "container",
            "x-data"() {
                return { __groupEl: this.$el };
            },
        });
    }
    function Y(i, e) {
        e.bind(i, {
            "x-show"() {
                return this.$data.__isOpen;
            },
        });
    }
    function g(i) {
        i
            .directive("menu", (e, t) => {
                t.value
                    ? t.value === "items"
                        ? tt(e, i)
                        : t.value === "item"
                        ? et(e, i)
                        : t.value === "button" && A(e, i)
                    : Z(e, i);
            })
            .before("bind"),
            i.magic("menuItem", (e) => {
                let t = i.$data(e);
                return {
                    get isActive() {
                        return t.__activeEl == t.__itemEl;
                    },
                    get isDisabled() {
                        return t.__itemEl.__isDisabled.value;
                    },
                };
            });
    }
    function Z(i, e) {
        e.bind(i, {
            "x-id"() {
                return ["alpine-menu-button", "alpine-menu-items"];
            },
            "x-modelable": "__isOpen",
            "x-data"() {
                return {
                    __itemEls: [],
                    __activeEl: null,
                    __isOpen: !1,
                    __open(t) {
                        (this.__isOpen = !0),
                            ((s) =>
                                requestAnimationFrame(() =>
                                    requestAnimationFrame(s)
                                ))(() => {
                                this.$refs.__items.focus({ preventScroll: !0 }),
                                    t &&
                                        t(e, this.$refs.__items, (s) =>
                                            s.__activate()
                                        );
                            });
                    },
                    __close(t = !0) {
                        (this.__isOpen = !1),
                            t &&
                                this.$nextTick(() =>
                                    this.$refs.__button.focus({
                                        preventScroll: !0,
                                    })
                                );
                    },
                    __contains(t, a) {
                        return !!e.findClosest(a, (s) => s.isSameNode(t));
                    },
                };
            },
            "@focusin.window"() {
                this.$data.__contains(this.$el, document.activeElement) ||
                    this.$data.__close(!1);
            },
        });
    }
    function A(i, e) {
        e.bind(i, {
            "x-ref": "__button",
            "aria-haspopup": "true",
            ":aria-labelledby"() {
                return this.$id("alpine-menu-label");
            },
            ":id"() {
                return this.$id("alpine-menu-button");
            },
            ":aria-expanded"() {
                return this.$data.__isOpen;
            },
            ":aria-controls"() {
                return this.$data.__isOpen && this.$id("alpine-menu-items");
            },
            "x-init"() {
                this.$el.tagName.toLowerCase() === "button" &&
                    !this.$el.hasAttribute("type") &&
                    (this.$el.type = "button");
            },
            "@click"() {
                this.$data.__open();
            },
            "@keydown.down.stop.prevent"() {
                this.$data.__open();
            },
            "@keydown.up.stop.prevent"() {
                this.$data.__open(d.last);
            },
            "@keydown.space.stop.prevent"() {
                this.$data.__open();
            },
            "@keydown.enter.stop.prevent"() {
                this.$data.__open();
            },
        });
    }
    function tt(i, e) {
        e.bind(i, {
            "x-ref": "__items",
            "aria-orientation": "vertical",
            role: "menu",
            ":id"() {
                return this.$id("alpine-menu-items");
            },
            ":aria-labelledby"() {
                return this.$id("alpine-menu-button");
            },
            ":aria-activedescendant"() {
                return this.$data.__activeEl && this.$data.__activeEl.id;
            },
            "x-show"() {
                return this.$data.__isOpen;
            },
            tabindex: "0",
            "@click.outside"() {
                this.$data.__close();
            },
            "@keydown"(t) {
                d.search(e, this.$refs.__items, t.key, (a) => a.__activate());
            },
            "@keydown.down.stop.prevent"() {
                this.$data.__activeEl
                    ? d.next(e, this.$data.__activeEl, (t) => t.__activate())
                    : d.first(e, this.$refs.__items, (t) => t.__activate());
            },
            "@keydown.up.stop.prevent"() {
                this.$data.__activeEl
                    ? d.previous(e, this.$data.__activeEl, (t) =>
                          t.__activate()
                      )
                    : d.last(e, this.$refs.__items, (t) => t.__activate());
            },
            "@keydown.home.stop.prevent"() {
                d.first(e, this.$refs.__items, (t) => t.__activate());
            },
            "@keydown.end.stop.prevent"() {
                d.last(e, this.$refs.__items, (t) => t.__activate());
            },
            "@keydown.page-up.stop.prevent"() {
                d.first(e, this.$refs.__items, (t) => t.__activate());
            },
            "@keydown.page-down.stop.prevent"() {
                d.last(e, this.$refs.__items, (t) => t.__activate());
            },
            "@keydown.escape.stop.prevent"() {
                this.$data.__close();
            },
            "@keydown.space.stop.prevent"() {
                this.$data.__activeEl && this.$data.__activeEl.click();
            },
            "@keydown.enter.stop.prevent"() {
                this.$data.__activeEl && this.$data.__activeEl.click();
            },
            "@keyup.space.prevent"() {},
        });
    }
    function et(i, e) {
        e.bind(i, () => ({
            "x-data"() {
                return {
                    __itemEl: this.$el,
                    init() {
                        let t = e.raw(this.$data.__itemEls),
                            a = !1;
                        for (let s = 0; s < t.length; s++)
                            if (
                                t[s].compareDocumentPosition(this.$el) &
                                Node.DOCUMENT_POSITION_PRECEDING
                            ) {
                                t.splice(s, 0, this.$el), (a = !0);
                                break;
                            }
                        a || t.push(this.$el),
                            (this.$el.__activate = () => {
                                (this.$data.__activeEl = this.$el),
                                    this.$el.scrollIntoView({
                                        block: "nearest",
                                    });
                            }),
                            (this.$el.__deactivate = () => {
                                this.$data.__activeEl = null;
                            }),
                            (this.$el.__isDisabled = e.reactive({ value: !1 })),
                            queueMicrotask(() => {
                                this.$el.__isDisabled.value = e.bound(
                                    this.$el,
                                    "disabled",
                                    !1
                                );
                            });
                    },
                    destroy() {
                        let t = this.$data.__itemEls;
                        t.splice(t.indexOf(this.$el), 1);
                    },
                };
            },
            "x-id"() {
                return ["alpine-menu-item"];
            },
            ":id"() {
                return this.$id("alpine-menu-item");
            },
            ":tabindex"() {
                return this.__itemEl.__isDisabled.value ? !1 : "-1";
            },
            role: "menuitem",
            "@mousemove"() {
                this.__itemEl.__isDisabled.value ||
                    this.$menuItem.isActive ||
                    this.__itemEl.__activate();
            },
            "@mouseleave"() {
                this.__itemEl.__isDisabled.value ||
                    !this.$menuItem.isActive ||
                    this.__itemEl.__deactivate();
            },
        }));
    }
    var d = {
        first(i, e, t = (s) => s, a = () => {}) {
            let s = i.$data(e).__itemEls[0];
            return s
                ? s.tagName.toLowerCase() === "template"
                    ? this.next(i, s, t)
                    : s.__isDisabled.value
                    ? this.next(i, s, t)
                    : t(s)
                : a();
        },
        last(i, e, t = (s) => s, a = () => {}) {
            let s = i.$data(e).__itemEls.slice(-1)[0];
            return s
                ? s.__isDisabled.value
                    ? this.previous(i, s, t)
                    : t(s)
                : a();
        },
        next(i, e, t = (s) => s, a = () => {}) {
            if (!e) return a();
            let s = i.$data(e).__itemEls,
                n = s[s.indexOf(e) + 1];
            return n
                ? n.__isDisabled.value || n.tagName.toLowerCase() === "template"
                    ? this.next(i, n, t, a)
                    : t(n)
                : a();
        },
        previous(i, e, t = (s) => s, a = () => {}) {
            if (!e) return a();
            let s = i.$data(e).__itemEls,
                n = s[s.indexOf(e) - 1];
            return n
                ? n.__isDisabled.value || n.tagName.toLowerCase() === "template"
                    ? this.previous(i, n, t, a)
                    : t(n)
                : a();
        },
        searchQuery: "",
        debouncedClearSearch: void 0,
        clearSearch(i) {
            this.debouncedClearSearch ||
                (this.debouncedClearSearch = i.debounce(function () {
                    this.searchQuery = "";
                }, 350)),
                this.debouncedClearSearch();
        },
        search(i, e, t, a) {
            if (t.length > 1) return;
            this.searchQuery += t;
            let n = i
                .raw(i.$data(e).__itemEls)
                .find((r) =>
                    r.textContent
                        .trim()
                        .toLowerCase()
                        .startsWith(this.searchQuery)
                );
            n && !n.__isDisabled.value && a(n), this.clearSearch(i);
        },
    };
    function O(i) {
        i
            .directive("switch", (e, t) => {
                t.value === "group"
                    ? it(e, i)
                    : t.value === "label"
                    ? at(e, i)
                    : t.value === "description"
                    ? nt(e, i)
                    : st(e, i);
            })
            .before("bind"),
            i.magic("switch", (e) => {
                let t = i.$data(e);
                return {
                    get isChecked() {
                        return t.__value === !0;
                    },
                };
            });
    }
    function it(i, e) {
        e.bind(i, {
            "x-id"() {
                return ["alpine-switch-label", "alpine-switch-description"];
            },
            "x-data"() {
                return {
                    __hasLabel: !1,
                    __hasDescription: !1,
                    __switchEl: void 0,
                };
            },
        });
    }
    function st(i, e) {
        e.bind(i, {
            "x-modelable": "__value",
            "x-data"() {
                return {
                    init() {
                        queueMicrotask(() => {
                            (this.__value = e.bound(
                                this.$el,
                                "default-checked",
                                !1
                            )),
                                (this.__inputName = e.bound(
                                    this.$el,
                                    "name",
                                    !1
                                )),
                                (this.__inputValue = e.bound(
                                    this.$el,
                                    "value",
                                    "on"
                                )),
                                (this.__inputId =
                                    "alpine-switch-" + Date.now());
                        });
                    },
                    __value: void 0,
                    __inputName: void 0,
                    __inputValue: void 0,
                    __inputId: void 0,
                    __toggle() {
                        this.__value = !this.__value;
                    },
                };
            },
            "x-effect"() {
                let t = this.__value;
                if (!this.__inputName) return;
                let a = this.$el.nextElementSibling;
                if (
                    (a && String(a.id) === String(this.__inputId) && a.remove(),
                    t)
                ) {
                    let s = document.createElement("input");
                    (s.type = "hidden"),
                        (s.value = this.__inputValue),
                        (s.name = this.__inputName),
                        (s.id = this.__inputId),
                        this.$el.after(s);
                }
            },
            "x-init"() {
                this.$el.tagName.toLowerCase() === "button" &&
                    !this.$el.hasAttribute("type") &&
                    (this.$el.type = "button"),
                    (this.$data.__switchEl = this.$el);
            },
            role: "switch",
            tabindex: "0",
            ":aria-checked"() {
                return !!this.__value;
            },
            ":aria-labelledby"() {
                return this.$data.__hasLabel && this.$id("alpine-switch-label");
            },
            ":aria-describedby"() {
                return (
                    this.$data.__hasDescription &&
                    this.$id("alpine-switch-description")
                );
            },
            "@click.prevent"() {
                this.__toggle();
            },
            "@keyup"(t) {
                t.key !== "Tab" && t.preventDefault(),
                    t.key === " " && this.__toggle();
            },
            "@keypress.prevent"() {},
        });
    }
    function at(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$data.__hasLabel = !0;
            },
            ":id"() {
                return this.$id("alpine-switch-label");
            },
            "@click"() {
                this.$data.__switchEl.click(),
                    this.$data.__switchEl.focus({ preventScroll: !0 });
            },
        });
    }
    function nt(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$data.__hasDescription = !0;
            },
            ":id"() {
                return this.$id("alpine-switch-description");
            },
        });
    }
    function w(i) {
        i
            .directive("radio", (e, t) => {
                t.value
                    ? t.value === "option"
                        ? _t(e, i)
                        : t.value === "label"
                        ? ot(e, i)
                        : t.value === "description" && lt(e, i)
                    : rt(e, i);
            })
            .before("bind"),
            i.magic("radioOption", (e) => {
                let t = i.$data(e);
                return {
                    get isActive() {
                        return t.__option === t.__active;
                    },
                    get isChecked() {
                        return t.__option === t.__value;
                    },
                    get isDisabled() {
                        let a = t.__disabled;
                        return t.__rootDisabled ? !0 : a;
                    },
                };
            });
    }
    function rt(i, e) {
        e.bind(i, {
            "x-modelable": "__value",
            "x-data"() {
                return {
                    init() {
                        queueMicrotask(() => {
                            (this.__rootDisabled = e.bound(i, "disabled", !1)),
                                (this.__value = e.bound(
                                    this.$el,
                                    "default-value",
                                    !1
                                )),
                                (this.__inputName = e.bound(
                                    this.$el,
                                    "name",
                                    !1
                                )),
                                (this.__inputId = "alpine-radio-" + Date.now());
                        }),
                            this.$nextTick(() => {
                                let t = document.createTreeWalker(
                                    this.$el,
                                    NodeFilter.SHOW_ELEMENT,
                                    {
                                        acceptNode: (a) =>
                                            a.getAttribute("role") === "radio"
                                                ? NodeFilter.FILTER_REJECT
                                                : a.hasAttribute("role")
                                                ? NodeFilter.FILTER_SKIP
                                                : NodeFilter.FILTER_ACCEPT,
                                    },
                                    !1
                                );
                                for (; t.nextNode(); )
                                    t.currentNode.setAttribute("role", "none");
                            });
                    },
                    __value: void 0,
                    __active: void 0,
                    __rootEl: this.$el,
                    __optionValues: [],
                    __disabledOptions: new Set(),
                    __optionElsByValue: new Map(),
                    __hasLabel: !1,
                    __hasDescription: !1,
                    __rootDisabled: !1,
                    __inputName: void 0,
                    __inputId: void 0,
                    __change(t) {
                        this.__rootDisabled || (this.__value = t);
                    },
                    __addOption(t, a, s) {
                        let n = e.raw(this.__optionValues),
                            r = n.map((o) => this.__optionElsByValue.get(o)),
                            _ = !1;
                        for (let o = 0; o < r.length; o++)
                            if (
                                r[o].compareDocumentPosition(a) &
                                Node.DOCUMENT_POSITION_PRECEDING
                            ) {
                                n.splice(o, 0, t),
                                    this.__optionElsByValue.set(t, a),
                                    (_ = !0);
                                break;
                            }
                        _ || (n.push(t), this.__optionElsByValue.set(t, a)),
                            s && this.__disabledOptions.add(t);
                    },
                    __isFirstOption(t) {
                        return this.__optionValues.indexOf(t) === 0;
                    },
                    __setActive(t) {
                        this.__active = t;
                    },
                    __focusOptionNext() {
                        let t = this.__active,
                            a = this.__optionValues.filter(
                                (n) => !this.__disabledOptions.has(n)
                            ),
                            s = a[this.__optionValues.indexOf(t) + 1];
                        (s = s || a[0]),
                            this.__optionElsByValue.get(s).focus(),
                            this.__change(s);
                    },
                    __focusOptionPrev() {
                        let t = this.__active,
                            a = this.__optionValues.filter(
                                (n) => !this.__disabledOptions.has(n)
                            ),
                            s = a[a.indexOf(t) - 1];
                        (s = s || a.slice(-1)[0]),
                            this.__optionElsByValue.get(s).focus(),
                            this.__change(s);
                    },
                };
            },
            "x-effect"() {
                let t = this.__value;
                if (!this.__inputName) return;
                let a = this.$el.nextElementSibling;
                if (
                    (a && String(a.id) === String(this.__inputId) && a.remove(),
                    t)
                ) {
                    let s = document.createElement("input");
                    (s.type = "hidden"),
                        (s.value = t),
                        (s.name = this.__inputName),
                        (s.id = this.__inputId),
                        this.$el.after(s);
                }
            },
            role: "radiogroup",
            "x-id"() {
                return ["alpine-radio-label", "alpine-radio-description"];
            },
            ":aria-labelledby"() {
                return this.__hasLabel && this.$id("alpine-radio-label");
            },
            ":aria-describedby"() {
                return (
                    this.__hasDescription &&
                    this.$id("alpine-radio-description")
                );
            },
            "@keydown.up.prevent.stop"() {
                this.__focusOptionPrev();
            },
            "@keydown.left.prevent.stop"() {
                this.__focusOptionPrev();
            },
            "@keydown.down.prevent.stop"() {
                this.__focusOptionNext();
            },
            "@keydown.right.prevent.stop"() {
                this.__focusOptionNext();
            },
        });
    }
    function _t(i, e) {
        e.bind(i, {
            "x-data"() {
                return {
                    init() {
                        queueMicrotask(() => {
                            (this.__disabled = e.bound(i, "disabled", !1)),
                                (this.__option = e.bound(i, "value")),
                                this.$data.__addOption(
                                    this.__option,
                                    this.$el,
                                    this.__disabled
                                );
                        });
                    },
                    __option: void 0,
                    __disabled: !1,
                    __hasLabel: !1,
                    __hasDescription: !1,
                };
            },
            "x-id"() {
                return ["alpine-radio-label", "alpine-radio-description"];
            },
            role: "radio",
            ":aria-checked"() {
                return this.$radioOption.isChecked;
            },
            ":aria-disabled"() {
                return this.$radioOption.isDisabled;
            },
            ":aria-labelledby"() {
                return this.__hasLabel && this.$id("alpine-radio-label");
            },
            ":aria-describedby"() {
                return (
                    this.__hasDescription &&
                    this.$id("alpine-radio-description")
                );
            },
            ":tabindex"() {
                return this.$radioOption.isDisabled
                    ? -1
                    : this.$radioOption.isChecked ||
                      (!this.$data.__value &&
                          this.$data.__isFirstOption(this.$data.__option))
                    ? 0
                    : -1;
            },
            "@click"() {
                this.$radioOption.isDisabled ||
                    (this.$data.__change(this.$data.__option),
                    this.$el.focus());
            },
            "@focus"() {
                this.$radioOption.isDisabled ||
                    this.$data.__setActive(this.$data.__option);
            },
            "@blur"() {
                this.$data.__active === this.$data.__option &&
                    this.$data.__setActive(void 0);
            },
            "@keydown.space.stop.prevent"() {
                this.$data.__change(this.$data.__option);
            },
        });
    }
    function ot(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$data.__hasLabel = !0;
            },
            ":id"() {
                return this.$id("alpine-radio-label");
            },
        });
    }
    function lt(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$data.__hasDescription = !0;
            },
            ":id"() {
                return this.$id("alpine-radio-description");
            },
        });
    }
    function k(i) {
        i
            .directive("tabs", (e, t) => {
                t.value
                    ? t.value === "list"
                        ? ut(e, i)
                        : t.value === "tab"
                        ? ht(e, i)
                        : t.value === "panels"
                        ? ct(e, i)
                        : t.value === "panel" && ft(e, i)
                    : dt(e, i);
            })
            .before("bind"),
            i.magic("tab", (e) => {
                let t = i.$data(e);
                return {
                    get isSelected() {
                        return (
                            t.__selectedIndex === t.__tabs.indexOf(t.__tabEl)
                        );
                    },
                    get isDisabled() {
                        return t.__isDisabled;
                    },
                };
            }),
            i.magic("panel", (e) => {
                let t = i.$data(e);
                return {
                    get isSelected() {
                        return (
                            t.__selectedIndex ===
                            t.__panels.indexOf(t.__panelEl)
                        );
                    },
                };
            });
    }
    function dt(i, e) {
        e.bind(i, {
            "x-modelable": "__selectedIndex",
            "x-data"() {
                return {
                    init() {
                        queueMicrotask(() => {
                            let t =
                                    this.__selectedIndex ||
                                    Number(
                                        e.bound(this.$el, "default-index", 0)
                                    ),
                                a = this.__activeTabs(),
                                s = (n, r, _) => Math.min(Math.max(n, r), _);
                            (this.__selectedIndex = s(t, 0, a.length - 1)),
                                e.effect(() => {
                                    this.__manualActivation = e.bound(
                                        this.$el,
                                        "manual",
                                        !1
                                    );
                                });
                        });
                    },
                    __tabs: [],
                    __panels: [],
                    __selectedIndex: null,
                    __tabGroupEl: void 0,
                    __manualActivation: !1,
                    __addTab(t) {
                        this.__tabs.push(t);
                    },
                    __addPanel(t) {
                        this.__panels.push(t);
                    },
                    __selectTab(t) {
                        this.__selectedIndex = this.__tabs.indexOf(t);
                    },
                    __activeTabs() {
                        return this.__tabs.filter((t) => !t.__disabled);
                    },
                };
            },
        });
    }
    function ut(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$data.__tabGroupEl = this.$el;
            },
        });
    }
    function ht(i, e) {
        e.bind(i, {
            "x-init"() {
                this.$el.tagName.toLowerCase() === "button" &&
                    !this.$el.hasAttribute("type") &&
                    (this.$el.type = "button");
            },
            "x-data"() {
                return {
                    init() {
                        (this.__tabEl = this.$el),
                            this.$data.__addTab(this.$el),
                            (this.__tabEl.__disabled = e.bound(
                                this.$el,
                                "disabled",
                                !1
                            )),
                            (this.__isDisabled = this.__tabEl.__disabled);
                    },
                    __tabEl: void 0,
                    __isDisabled: !1,
                };
            },
            "@click"() {
                this.$el.__disabled ||
                    (this.$data.__selectTab(this.$el), this.$el.focus());
            },
            "@keydown.enter.prevent.stop"() {
                this.__selectTab(this.$el);
            },
            "@keydown.space.prevent.stop"() {
                this.__selectTab(this.$el);
            },
            "@keydown.home.prevent.stop"() {
                this.$focus.within(this.$data.__activeTabs()).first();
            },
            "@keydown.page-up.prevent.stop"() {
                this.$focus.within(this.$data.__activeTabs()).first();
            },
            "@keydown.end.prevent.stop"() {
                this.$focus.within(this.$data.__activeTabs()).last();
            },
            "@keydown.page-down.prevent.stop"() {
                this.$focus.within(this.$data.__activeTabs()).last();
            },
            "@keydown.down.prevent.stop"() {
                this.$focus
                    .within(this.$data.__activeTabs())
                    .withWrapAround()
                    .next();
            },
            "@keydown.right.prevent.stop"() {
                this.$focus
                    .within(this.$data.__activeTabs())
                    .withWrapAround()
                    .next();
            },
            "@keydown.up.prevent.stop"() {
                this.$focus
                    .within(this.$data.__activeTabs())
                    .withWrapAround()
                    .prev();
            },
            "@keydown.left.prevent.stop"() {
                this.$focus
                    .within(this.$data.__activeTabs())
                    .withWrapAround()
                    .prev();
            },
            ":tabindex"() {
                return this.$tab.isSelected ? 0 : -1;
            },
            "@focus"() {
                if (this.$data.__manualActivation) this.$el.focus();
                else {
                    if (this.$el.__disabled) return;
                    this.$data.__selectTab(this.$el), this.$el.focus();
                }
            },
        });
    }
    function ct(i, e) {
        e.bind(i, {});
    }
    function ft(i, e) {
        e.bind(i, {
            ":tabindex"() {
                return this.$panel.isSelected ? 0 : -1;
            },
            "x-data"() {
                return {
                    init() {
                        (this.__panelEl = this.$el),
                            this.$data.__addPanel(this.$el);
                    },
                    __panelEl: void 0,
                };
            },
            "x-show"() {
                return this.$panel.isSelected;
            },
        });
    }
    function E(i) {
        b(i), v(i), m(i), x(i), g(i), O(i), y(i), w(i), k(i);
    }
    document.addEventListener("alpine:init", () => {
        window.Alpine.plugin(E);
    });
})();
