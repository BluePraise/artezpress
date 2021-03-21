jQuery(function (f) {
    if ("undefined" == typeof wc_checkout_params) return !1;
    var g = {
        updateTimer: !(f.blockUI.defaults.overlayCSS.cursor = "default"),
        dirtyInput: !1,
        selectedPaymentMethod: !1,
        xhr: !1,
        $order_review: f("#order_review"),
        $checkout_form: f("form.checkout"),
        init: function () {
            f(document.body).bind("update_checkout", this.update_checkout), f(document.body).bind("init_checkout", this.init_checkout), this.$checkout_form.on("click", 'input[name="payment_method"]', this.payment_method_selected), f(document.body).hasClass("woocommerce-order-pay") && (this.$order_review.on("click", 'input[name="payment_method"]', this.payment_method_selected), this.$order_review.on("submit", this.submitOrder), this.$order_review.attr("novalidate", "novalidate")), this.$checkout_form.attr("novalidate", "novalidate"), this.$checkout_form.on("submit", this.submit), this.$checkout_form.on("input validate change", ".input-text, select, input:checkbox", this.validate_field), this.$checkout_form.on("update", this.trigger_update_checkout), this.$checkout_form.on("change", 'select.shipping_method, input[name^="shipping_method"], #ship-to-different-address input, .update_totals_on_change select, .update_totals_on_change input[type="radio"], .update_totals_on_change input[type="checkbox"]', this.trigger_update_checkout), this.$checkout_form.on("change", ".address-field select", this.input_changed), this.$checkout_form.on("change", ".address-field input.input-text, .update_totals_on_change input.input-text", this.maybe_input_changed), this.$checkout_form.on("keydown", ".address-field input.input-text, .update_totals_on_change input.input-text", this.queue_update_checkout), this.$checkout_form.on("change", "#ship-to-different-address input", this.ship_to_different_address), this.$checkout_form.find("#ship-to-different-address input").change(), this.init_payment_methods(), "1" === wc_checkout_params.is_checkout && f(document.body).trigger("init_checkout"), "yes" === wc_checkout_params.option_guest_checkout && f("input#createaccount").change(this.toggle_create_account).change()
        },
        init_payment_methods: function () {
            var e = f(".woocommerce-checkout").find('input[name="payment_method"]');
            1 === e.length && e.eq(0).hide(), g.selectedPaymentMethod && f("#" + g.selectedPaymentMethod).prop("checked", !0), 0 === e.filter(":checked").length && e.eq(0).prop("checked", !0);
            var t = e.filter(":checked").eq(0).prop("id");
            1 < e.length && f('div.payment_box:not(".' + t + '")').filter(":visible").slideUp(0), e.filter(":checked").eq(0).trigger("click")
        },
        get_payment_method: function () {
            return g.$checkout_form.find('input[name="payment_method"]:checked').val()
        },
        payment_method_selected: function (e) {
            e.stopPropagation(), 1 < f(".payment_methods input.input-radio").length ? (t = f("div.payment_box." + f(this).attr("ID")), (e = f(this).is(":checked")) && !t.is(":visible") && (f("div.payment_box").filter(":visible").slideUp(230), e && t.slideDown(230))) : f("div.payment_box").show(), f(this).data("order_button_text") ? f("#place_order").text(f(this).data("order_button_text")) : f("#place_order").text(f("#place_order").data("value"));
            var t = f('.woocommerce-checkout input[name="payment_method"]:checked').attr("id");
            t !== g.selectedPaymentMethod && f(document.body).trigger("payment_method_selected"), g.selectedPaymentMethod = t
        },
        toggle_create_account: function () {
            f("div.create-account").hide(), f(this).is(":checked") && (f("#account_password").val("").change(), f("div.create-account").slideDown())
        },
        init_checkout: function () {
            f(document.body).trigger("update_checkout")
        },
        maybe_input_changed: function (e) {
            g.dirtyInput && g.input_changed(e)
        },
        input_changed: function (e) {
            g.dirtyInput = e.target, g.maybe_update_checkout()
        },
        queue_update_checkout: function (e) {
            if (9 === (e.keyCode || e.which || 0)) return !0;
            g.dirtyInput = this, g.reset_update_checkout_timer(), g.updateTimer = setTimeout(g.maybe_update_checkout, "1000")
        },
        trigger_update_checkout: function () {
            g.reset_update_checkout_timer(), g.dirtyInput = !1, f(document.body).trigger("update_checkout")
        },
        maybe_update_checkout: function () {
            var e, t = !0;
            !f(g.dirtyInput).length || (e = f(g.dirtyInput).closest("div").find(".address-field.validate-required")).length && e.each(function () {
                "" === f(this).find("input.input-text").val() && (t = !1)
            }), t && g.trigger_update_checkout()
        },
        ship_to_different_address: function () {
            f("div.shipping_address").hide(), f(this).is(":checked") && f("div.shipping_address").slideDown()
        },
        reset_update_checkout_timer: function () {
            clearTimeout(g.updateTimer)
        },
        is_valid_json: function (e) {
            try {
                var t = JSON.parse(e);
                return t && "object" == typeof t
            } catch (o) {
                return !1
            }
        },
        validate_field: function (e) {
            var t = f(this),
                o = t.closest(".form-row"),
                c = !0,
                i = o.is(".validate-required"),
                n = o.is(".validate-email"),
                e = e.type;
            "input" === e && o.removeClass("woocommerce-invalid woocommerce-invalid-required-field woocommerce-invalid-email woocommerce-validated"), "validate" !== e && "change" !== e || (i && ("checkbox" === t.attr("type") && !t.is(":checked") || "" === t.val()) && (o.removeClass("woocommerce-validated").addClass("woocommerce-invalid woocommerce-invalid-required-field"), c = !1), n && t.val() && (new RegExp(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[0-9a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i).test(t.val()) || (o.removeClass("woocommerce-validated").addClass("woocommerce-invalid woocommerce-invalid-email"), c = !1)), c && o.removeClass("woocommerce-invalid woocommerce-invalid-required-field woocommerce-invalid-email").addClass("woocommerce-validated"))
        },
        update_checkout: function (e, t) {
            g.reset_update_checkout_timer(), g.updateTimer = setTimeout(g.update_checkout_action, "5", t)
        },
        update_checkout_action: function (e) {
            var t, o, c, i, n, r, a, u, d, s, m, h, l, p, _;
            g.xhr && g.xhr.abort(), 0 !== f("form.checkout").length && (e = void 0 !== e ? e : {
                update_shipping_method: !0
            }, a = t = f("#billing_country").val(), u = o = f("#billing_state").val(), d = c = f(":input#billing_postcode").val(), s = i = f("#billing_city").val(), m = n = f(":input#billing_address_1").val(), p = r = f(":input#billing_address_2").val(), h = f(g.$checkout_form).find(".address-field.validate-required:visible"), l = !0, h.length && h.each(function () {
                "" === f(this).find(":input").val() && (l = !1)
            }), f("#ship-to-different-address").find("input").is(":checked") && (a = f("#shipping_country").val(), u = f("#shipping_state").val(), d = f(":input#shipping_postcode").val(), s = f("#shipping_city").val(), m = f(":input#shipping_address_1").val(), p = f(":input#shipping_address_2").val()), !(p = {
                security: wc_checkout_params.update_order_review_nonce,
                payment_method: g.get_payment_method(),
                country: t,
                state: o,
                postcode: c,
                city: i,
                address: n,
                address_2: r,
                s_country: a,
                s_state: u,
                s_postcode: d,
                s_city: s,
                s_address: m,
                s_address_2: p,
                has_full_address: l,
                post_data: f("form.checkout").serialize()
            }) !== e.update_shipping_method && (_ = {}, f('select.shipping_method, input[name^="shipping_method"][type="radio"]:checked, input[name^="shipping_method"][type="hidden"]').each(function () {
                _[f(this).data("index")] = f(this).val()
            }), p.shipping_method = _), f(".woocommerce-checkout-payment, .woocommerce-checkout-review-order-table").block({
                message: null,
                overlayCSS: {
                    background: "#fff",
                    opacity: .6
                }
            }), g.xhr = f.ajax({
                type: "POST",
                url: wc_checkout_params.wc_ajax_url.toString().replace("%%endpoint%%", "update_order_review"),
                data: p,
                success: function (e) {
                    var t, o;
                    e && !0 === e.reload ? window.location.reload() : (f(".woocommerce-NoticeGroup-updateOrderReview").remove(), o = f("#terms").prop("checked"), t = {}, f(".payment_box :input").each(function () {
                        var e = f(this).attr("id");
                        e && (-1 !== f.inArray(f(this).attr("type"), ["checkbox", "radio"]) ? t[e] = f(this).prop("checked") : t[e] = f(this).val())
                    }), e && e.fragments && (f.each(e.fragments, function (e, t) {
                        g.fragments && g.fragments[e] === t || f(e).replaceWith(t), f(e).unblock()
                    }), g.fragments = e.fragments), o && f("#terms").prop("checked", !0), f.isEmptyObject(t) || f(".payment_box :input").each(function () {
                        var e = f(this).attr("id");
                        e && (-1 !== f.inArray(f(this).attr("type"), ["checkbox", "radio"]) ? f(this).prop("checked", t[e]).change() : (-1 !== f.inArray(f(this).attr("type"), ["select"]) || null !== f(this).val() && 0 === f(this).val().length) && f(this).val(t[e]).change())
                    }), e && "failure" === e.result && (o = f("form.checkout"), f(".woocommerce-error, .woocommerce-message").remove(), e.messages ? o.prepend('<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-updateOrderReview">' + e.messages + "</div>") : o.prepend(e), o.find(".input-text, select, input:checkbox").trigger("validate").blur(), g.scroll_to_notices()), g.init_payment_methods(), f(document.body).trigger("updated_checkout", [e]))
                }
            }))
        },
        handleUnloadEvent: function (e) {
            return -1 === navigator.userAgent.indexOf("MSIE") && !document.documentMode || (e.preventDefault(), undefined)
        },
        attachUnloadEventsOnSubmit: function () {
            f(window).on("beforeunload", this.handleUnloadEvent)
        },
        detachUnloadEventsOnSubmit: function () {
            f(window).unbind("beforeunload", this.handleUnloadEvent)
        },
        blockOnSubmit: function (e) {
            1 !== e.data()["blockUI.isBlocked"] && e.block({
                message: null,
                overlayCSS: {
                    background: "#fff",
                    opacity: .6
                }
            })
        },
        submitOrder: function () {
            g.blockOnSubmit(f(this))
        },
        submit: function () {
            g.reset_update_checkout_timer();
            var o = f(this);
            return o.is(".processing") || !1 !== o.triggerHandler("checkout_place_order") && !1 !== o.triggerHandler("checkout_place_order_" + g.get_payment_method()) && (o.addClass("processing"), g.blockOnSubmit(o), g.attachUnloadEventsOnSubmit(), f.ajaxSetup({
                dataFilter: function (e, t) {
                    if ("json" !== t) return e;
                    if (g.is_valid_json(e)) return e;
                    t = e.match(/{"result.*}/);
                    return null !== t && g.is_valid_json(t[0]) ? (console.log("Fixed malformed JSON. Original:"), console.log(e), e = t[0]) : console.log("Unable to fix malformed JSON"), e
                }
            }), f.ajax({
                type: "POST",
                url: wc_checkout_params.checkout_url,
                data: o.serialize(),
                dataType: "json",
                success: function (e) {
                    g.detachUnloadEventsOnSubmit();
                    try {
                        if ("success" !== e.result || !1 === o.triggerHandler("checkout_place_order_success")) throw "failure" === e.result ? "Result failure" : "Invalid response"; - 1 === e.redirect.indexOf("https://") || -1 === e.redirect.indexOf("http://") ? window.location = e.redirect : window.location = decodeURI(e.redirect)
                    } catch (t) {
                        if (!0 === e.reload) return void window.location.reload();
                        !0 === e.refresh && f(document.body).trigger("update_checkout"), e.messages ? g.submit_error(e.messages) : g.submit_error('<div class="woocommerce-error">' + wc_checkout_params.i18n_checkout_error + "</div>")
                    }
                },
                error: function (e, t, o) {
                    g.detachUnloadEventsOnSubmit(), g.submit_error('<div class="woocommerce-error">' + o + "</div>")
                }
            })), !1
        },
        submit_error: function (e) {
            f(".woocommerce-NoticeGroup-checkout, .woocommerce-error, .woocommerce-message").remove(), g.$checkout_form.prepend('<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout">' + e + "</div>"), g.$checkout_form.removeClass("processing").unblock(), g.$checkout_form.find(".input-text, select, input:checkbox").trigger("validate").blur(), g.scroll_to_notices(), f(document.body).trigger("checkout_error", [e])
        },
        scroll_to_notices: function () {
            var e = f(".woocommerce-NoticeGroup-updateOrderReview, .woocommerce-NoticeGroup-checkout");
            e.length || (e = f(".form.checkout")), f.scroll_to_notices(e)
        }
    },
        e = {
            init: function () {
                f(document.body).on("click", "a.showcoupon", this.show_coupon_form), f(document.body).on("click", ".woocommerce-remove-coupon", this.remove_coupon), f("form.checkout_coupon").hide().submit(this.submit)
            },
            show_coupon_form: function () {
                return f(".checkout_coupon").slideToggle(400, function () {
                    f(".checkout_coupon").find(":input:eq(0)").focus()
                }), !1
            },
            submit: function () {
                var t = f(this);
                if (t.is(".processing")) return !1;
                t.addClass("processing").block({
                    message: null,
                    overlayCSS: {
                        background: "#fff",
                        opacity: .6
                    }
                });
                var o = {
                    security: wc_checkout_params.apply_coupon_nonce,
                    coupon_code: t.find('input[name="coupon_code"]').val()
                };
                return f.ajax({
                    type: "POST",
                    url: wc_checkout_params.wc_ajax_url.toString().replace("%%endpoint%%", "apply_coupon"),
                    data: o,
                    success: function (e) {
                        f(".woocommerce-error, .woocommerce-message").remove(), t.removeClass("processing").unblock(), e && (t.before(e), t.slideUp(), f(document.body).trigger("applied_coupon_in_checkout", [o.coupon_code]), f(document.body).trigger("update_checkout", {
                            update_shipping_method: !1
                        }))
                    },
                    dataType: "html"
                }), !1
            },
            remove_coupon: function (e) {
                e.preventDefault();
                var t = f(this).parents(".woocommerce-checkout-review-order"),
                    e = f(this).data("coupon");
                t.addClass("processing").block({
                    message: null,
                    overlayCSS: {
                        background: "#fff",
                        opacity: .6
                    }
                });
                var o = {
                    security: wc_checkout_params.remove_coupon_nonce,
                    coupon: e
                };
                f.ajax({
                    type: "POST",
                    url: wc_checkout_params.wc_ajax_url.toString().replace("%%endpoint%%", "remove_coupon"),
                    data: o,
                    success: function (e) {
                        f(".woocommerce-error, .woocommerce-message").remove(), t.removeClass("processing").unblock(), e && (f("form.woocommerce-checkout").before(e), f(document.body).trigger("removed_coupon_in_checkout", [o.coupon_code]), f(document.body).trigger("update_checkout", {
                            update_shipping_method: !1
                        }), f("form.checkout_coupon").find('input[name="coupon_code"]').val(""))
                    },
                    error: function (e) {
                        wc_checkout_params.debug_mode && console.log(e.responseText)
                    },
                    dataType: "html"
                })
            }
        },
        t = {
            init: function () {
                f(document.body).on("click", "a.showlogin", this.show_login_form)
            },
            show_login_form: function () {
                return f("form.login, form.woocommerce-form--login").slideToggle(), !1
            }
        },
        o = {
            init: function () {
                f(document.body).on("click", "a.woocommerce-terms-and-conditions-link", this.toggle_terms)
            },
            toggle_terms: function () {
                if (f(".woocommerce-terms-and-conditions").length) return f(".woocommerce-terms-and-conditions").slideToggle(function () {
                    var e = f(".woocommerce-terms-and-conditions-link");
                    f(".woocommerce-terms-and-conditions").is(":visible") ? (e.addClass("woocommerce-terms-and-conditions-link--open"), e.removeClass("woocommerce-terms-and-conditions-link--closed")) : (e.removeClass("woocommerce-terms-and-conditions-link--open"), e.addClass("woocommerce-terms-and-conditions-link--closed"))
                }), !1
            }
        };
    g.init(), e.init(), t.init(), o.init()
});