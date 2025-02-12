/*

=========================================================
* Volt Pro - Premium Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal. Contact us if you want to remove it.

*/

"use strict";

import * as bootstrap from "bootstrap";
import Swal from "sweetalert2";
import SmoothScroll from "smooth-scroll";
import { Datepicker } from "vanillajs-datepicker";

window.Swal = Swal;

const d = document;
d.addEventListener("DOMContentLoaded", function (event) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-primary me-3",
            cancelButton: "btn btn-gray",
        },
        buttonsStyling: false,
    });

    // options
    const breakpoints = {
        sm: 540,
        md: 720,
        lg: 960,
        xl: 1140,
    };

    var sidebar = document.getElementById("sidebarMenu");
    if (sidebar && d.body.clientWidth < breakpoints.lg) {
        sidebar.addEventListener("shown.bs.collapse", function () {
            document.querySelector("body").style.position = "fixed";
        });
        sidebar.addEventListener("hidden.bs.collapse", function () {
            document.querySelector("body").style.position = "relative";
        });
    }

    var iconNotifications = d.querySelector(".notification-bell");
    if (iconNotifications) {
        iconNotifications.addEventListener("shown.bs.dropdown", function () {
            iconNotifications.classList.remove("unread");
        });
    }

    [].slice.call(d.querySelectorAll("[data-background]")).map(function (el) {
        el.style.background = "url(" + el.getAttribute("data-background") + ")";
    });

    [].slice
        .call(d.querySelectorAll("[data-background-lg]"))
        .map(function (el) {
            if (document.body.clientWidth > breakpoints.lg) {
                el.style.background =
                    "url(" + el.getAttribute("data-background-lg") + ")";
            }
        });

    [].slice
        .call(d.querySelectorAll("[data-background-color]"))
        .map(function (el) {
            el.style.background =
                "url(" + el.getAttribute("data-background-color") + ")";
        });

    [].slice.call(d.querySelectorAll("[data-color]")).map(function (el) {
        el.style.color = "url(" + el.getAttribute("data-color") + ")";
    });

    //Tooltips
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Popovers
    var popoverTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Datepicker
    var datepickers = [].slice.call(d.querySelectorAll("[data-datepicker]"));
    var datepickersList = datepickers.map(function (el) {
        return new Datepicker(el, {
            buttonClass: "btn",
        });
    });

    if (d.querySelector(".input-slider-container")) {
        [].slice
            .call(d.querySelectorAll(".input-slider-container"))
            .map(function (el) {
                var slider = el.querySelector(":scope .input-slider");
                var sliderId = slider.getAttribute("id");
                var minValue = slider.getAttribute("data-range-value-min");
                var maxValue = slider.getAttribute("data-range-value-max");

                var sliderValue = el.querySelector(
                    ":scope .range-slider-value"
                );
                var sliderValueId = sliderValue.getAttribute("id");
                var startValue = sliderValue.getAttribute(
                    "data-range-value-low"
                );

                var c = d.getElementById(sliderId),
                    id = d.getElementById(sliderValueId);

                noUiSlider.create(c, {
                    start: [parseInt(startValue)],
                    connect: [true, false],
                    //step: 1000,
                    range: {
                        min: [parseInt(minValue)],
                        max: [parseInt(maxValue)],
                    },
                });
            });
    }

    if (d.getElementById("input-slider-range")) {
        var c = d.getElementById("input-slider-range"),
            low = d.getElementById("input-slider-range-value-low"),
            e = d.getElementById("input-slider-range-value-high"),
            f = [d, e];

        noUiSlider.create(c, {
            start: [
                parseInt(low.getAttribute("data-range-value-low")),
                parseInt(e.getAttribute("data-range-value-high")),
            ],
            connect: !0,
            tooltips: true,
            range: {
                min: parseInt(c.getAttribute("data-range-value-min")),
                max: parseInt(c.getAttribute("data-range-value-max")),
            },
        }),
            c.noUiSlider.on("update", function (a, b) {
                f[b].textContent = a[b];
            });
    }

    if (d.getElementById("loadOnClick")) {
        d.getElementById("loadOnClick").addEventListener("click", function () {
            var button = this;
            var loadContent = d.getElementById("extraContent");
            var allLoaded = d.getElementById("allLoadedText");

            button.classList.add("btn-loading");
            button.setAttribute("disabled", "true");

            setTimeout(function () {
                loadContent.style.display = "block";
                button.style.display = "none";
                allLoaded.style.display = "block";
            }, 1500);
        });
    }

    var scroll = new SmoothScroll('a[href*="#"]', {
        speed: 500,
        speedAsDuration: true,
    });

    if (d.querySelector(".current-year")) {
        d.querySelector(".current-year").textContent = new Date().getFullYear();
    }

    // Glide JS

    if (d.querySelector(".glide")) {
        new Glide(".glide", {
            type: "carousel",
            startAt: 0,
            perView: 3,
        }).mount();
    }

    if (d.querySelector(".glide-autoplay")) {
        new Glide(".glide-autoplay", {
            type: "carousel",
            startAt: 0,
            perView: 3,
            autoplay: 2000,
        }).mount();
    }
});
