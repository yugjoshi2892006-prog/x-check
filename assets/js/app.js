$(function () {
	"use strict";

	var $window = $(window);
	var $document = $(document);
	var $wrapper = $(".wrapper");
	var $sidebar = $(".sidebar-wrapper");
	var $menu = $("#menu");

	function initPerfectScrollbar(selector) {
		if (typeof PerfectScrollbar === "undefined") {
			return;
		}

		var element = document.querySelector(selector);
		if (!element) {
			return;
		}

		new PerfectScrollbar(element);
	}

	function isMobileViewport() {
		return window.innerWidth <= 1024;
	}

	function closeMobileSidebar() {
		if (isMobileViewport()) {
			$wrapper.removeClass("toggled sidebar-hovered");
		}
	}

	function toggleSidebar() {
		$wrapper.toggleClass("toggled");

		if (!$wrapper.hasClass("toggled")) {
			$wrapper.removeClass("sidebar-hovered");
		}
	}

	function bindDesktopHover() {
		if (isMobileViewport()) {
			$sidebar.off("mouseenter.sidebarHover mouseleave.sidebarHover");
			$wrapper.removeClass("sidebar-hovered");
			return;
		}

		$sidebar.off("mouseenter.sidebarHover mouseleave.sidebarHover");
		$sidebar.on("mouseenter.sidebarHover", function () {
			if ($wrapper.hasClass("toggled")) {
				$wrapper.addClass("sidebar-hovered");
			}
		});
		$sidebar.on("mouseleave.sidebarHover", function () {
			$wrapper.removeClass("sidebar-hovered");
		});
	}

	function initMenuState() {
		if (!$menu.length) {
			return;
		}

		$menu.find("li").each(function () {
			var $li = $(this);
			var $submenu = $li.children("ul");

			if (!$submenu.length) {
				return;
			}

			if ($li.hasClass("mm-active")) {
				$submenu.addClass("mm-show").show();
			} else {
				$submenu.removeClass("mm-show").hide();
			}
		});
	}

	function bindAccordionMenu() {
		if (!$menu.length) {
			return;
		}

		$menu.off("click.sidebarMenu", "> li > a.has-arrow");
		$menu.on("click.sidebarMenu", "> li > a.has-arrow", function (event) {
			event.preventDefault();

			var $link = $(this);
			var $parentLi = $link.parent("li");
			var $submenu = $parentLi.children("ul");
			var isOpen = $parentLi.hasClass("mm-active");

			$menu.children("li").each(function () {
				var $li = $(this);
				var $childMenu = $li.children("ul");

				if (!$childMenu.length || $li.is($parentLi)) {
					return;
				}

				$li.removeClass("mm-active");
				$li.children("a").removeClass("active");
				$childMenu.stop(true, true).slideUp(180).removeClass("mm-show");
			});

			if (isOpen) {
				$parentLi.removeClass("mm-active");
				$link.removeClass("active");
				$submenu.stop(true, true).slideUp(180).removeClass("mm-show");
				return;
			}

			$parentLi.addClass("mm-active");
			$link.addClass("active");
			$submenu.stop(true, true).slideDown(180).addClass("mm-show");
		});
	}

	function normalizeUrl(url) {
		var anchor = document.createElement("a");
		anchor.href = url;
		return anchor.pathname.replace(/\/+$/, "");
	}

	function markActiveMenu() {
		if (!$menu.length) {
			return;
		}

		var currentPath = normalizeUrl(window.location.href);
		var $activeLink = $menu.find("a[href]").filter(function () {
			var href = $(this).attr("href");
			if (!href || href === "javascript:;") {
				return false;
			}

			return normalizeUrl(href) === currentPath;
		}).last();

		if (!$activeLink.length) {
			return;
		}

		$activeLink.addClass("active");

		var $currentLi = $activeLink.parent("li");
		$currentLi.addClass("mm-active");

		$currentLi.parents("li").addClass("mm-active");
		$currentLi.parents("ul").addClass("mm-show").css("height", "auto");
	}

	function applyTheme(theme) {
		var normalizedTheme = theme || "light";
		var $html = $("html");
		var $icon = $(".dark-mode-icon i");

		$html.attr("data-bs-theme", normalizedTheme);
		$html.toggleClass("dark-theme", normalizedTheme === "dark");
		$html.toggleClass("semi-dark", normalizedTheme === "semi-dark");
		$html.toggleClass("bordered-theme", normalizedTheme === "bodered-theme");

		if ($icon.length) {
			$icon.attr("class", normalizedTheme === "dark" ? "bx bx-sun" : "bx bx-moon");
		}

		$("#LightTheme").prop("checked", normalizedTheme === "light");
		$("#DarkTheme").prop("checked", normalizedTheme === "dark");
		$("#SemiDarkTheme").prop("checked", normalizedTheme === "semi-dark");
		$("#BoderedTheme").prop("checked", normalizedTheme === "bodered-theme");
	}

	initPerfectScrollbar(".app-container");
	initPerfectScrollbar(".header-message-list");
	initPerfectScrollbar(".header-notifications-list");
	applyTheme(localStorage.getItem("theme") || $("html").attr("data-bs-theme") || "light");

	$(".mobile-toggle-icon, .mobile-toggle-menu, .overlay").on("click", function () {
		toggleSidebar();
	});

	$(".dark-mode").on("click", function () {
		var currentTheme = $("html").attr("data-bs-theme") || "light";
		var newTheme = currentTheme === "dark" ? "light" : "dark";

		localStorage.setItem("theme", newTheme);
		applyTheme(newTheme);
	});

	$window.on("scroll", function () {
		$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut();
	});

	$(".back-to-top").on("click", function () {
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});

	initMenuState();
	bindAccordionMenu();
	markActiveMenu();
	bindDesktopHover();

	$window.on("resize", bindDesktopHover);

	$menu.on("click", "a:not(.has-arrow)", function () {
		closeMobileSidebar();
	});

	$(".chat-toggle-btn").on("click", function () {
		$(".chat-wrapper").toggleClass("chat-toggled");
	});

	$(".chat-toggle-btn-mobile").on("click", function () {
		$(".chat-wrapper").removeClass("chat-toggled");
	});

	$(".email-toggle-btn").on("click", function () {
		$(".email-wrapper").toggleClass("email-toggled");
	});

	$(".email-toggle-btn-mobile").on("click", function () {
		$(".email-wrapper").removeClass("email-toggled");
	});

	$(".compose-mail-btn").on("click", function () {
		$(".compose-mail-popup").show();
	});

	$(".compose-mail-close").on("click", function () {
		$(".compose-mail-popup").hide();
	});

	$("#LightTheme").on("click", function () {
		localStorage.setItem("theme", "light");
		applyTheme("light");
	});

	$("#DarkTheme").on("click", function () {
		localStorage.setItem("theme", "dark");
		applyTheme("dark");
	});

	$("#SemiDarkTheme").on("click", function () {
		localStorage.setItem("theme", "semi-dark");
		applyTheme("semi-dark");
	});

	$("#BoderedTheme").on("click", function () {
		localStorage.setItem("theme", "bodered-theme");
		applyTheme("bodered-theme");
	});

	$(".switcher-btn").on("click", function () {
		$(".switcher-wrapper").toggleClass("switcher-toggled");
	});

	$(".close-switcher").on("click", function () {
		$(".switcher-wrapper").removeClass("switcher-toggled");
	});
});
