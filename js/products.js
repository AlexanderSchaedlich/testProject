let filteredProducts;
let filteringCriteria = {};
let font = parseFloat(getComputedStyle(document.documentElement).fontSize);
let currentWidth;
let storageIsAvailable;
if (checkStorageAvailability('sessionStorage')) {
    storageIsAvailable = true;
} else {
    storageIsAvailable = false;
}
function filterProducts(criteria) {
	filteredProducts = products.slice(); // creates a shallow copy of the array
	for (product of products) {
		for (attribute in criteria) {
			let filterOut = true;
			for (criterion of criteria[attribute]) {
				if (product[attribute] == criterion) {
					filterOut = false;
				}
			}
			if (filterOut && filteredProducts.includes(product)) {
				filteredProducts.splice(filteredProducts.indexOf(product), 1);
			}
		}
	}
	writeBar(criteria);
	let sortingCriteria = document.getElementById("sort").value.split(" ");
	sortProducts(sortingCriteria[0], sortingCriteria[1]);
}
function writeBar(criteria) {
	let items = "";
	let showItems = "";
	switch (filteredProducts.length) {
		case 0:
			items += "No items";
			showItems += "No items";
			break;
		case 1:
			items += "1 item";
			showItems += "Show 1 item";
			break;
		default:
			items += filteredProducts.length.toString() + " items";
			showItems += "Show " + filteredProducts.length.toString() + " items";
			break;
	}
	$("#filteredProductsItems").empty();
	$("#filteredProductsItems").append(items);
	$("#verticalBar button").empty();
	$("#verticalBar button").append(showItems);
	$("#criteriaBar").empty();
	for (attribute in criteria) {
		for (criterion of criteria[attribute]) {
			$("#criteriaBar").append(`
				<span class="criterion pr-3">
					<span>${criterion.charAt(0).toUpperCase() + criterion.slice(1)}</span>
					<span onclick="removeCriterion('${criterion}')">&#10005;</span>
				</span>
	    	`);
		}
	}
	checkLineBreak();
	checkOverflow();
}
function removeCriterion(string) {
	$("input[value = " + string + "]").trigger("click");
}
function checkLineBreak() {
	let appliedCriteria = document.getElementsByClassName("criterion");
	for (criterion of appliedCriteria) {
		if (criterion.offsetHeight > 1.65 * font) {
			criterion.prepend(document.createElement("br"));
		} 
	}
}
function checkOverflow() {
	let criteriaBar = document.getElementById("criteriaBar");
	let criteriaButton = document.getElementById("criteriaButton");
	if (criteriaBar.scrollHeight >= 2 * criteriaBar.offsetHeight) {
		criteriaButton.style.visibility = "visible";
	} else {
		if (criteriaBar.offsetHeight >= 2 * 1.65 * font) {
			criteriaButton.style.visibility = "visible";
		} else {
			criteriaButton.style.visibility = "hidden";
		}
	}
}
function sortProducts(attribute, order) {
	filteredProducts.sort(function(a, b) {
		switch (attribute) {
			case 'new_price':
				if (order == 'ascending') {
					return a[attribute] - b[attribute]; // swaps the elements if the returned value is less than zero
				} else {
					return b[attribute] - a[attribute];
				}
				break;
			case 'adding_date':
				return new Date(b[attribute]) - new Date(a[attribute]);
				break;
			case 'stars':
				return b[attribute] - a[attribute];
				break;
		}
	});
	writeCards();
}
function writeCards() {
	$("#cards").empty();
	for (let product of filteredProducts) {
		$("#cards").append(`
			<div class="col-sm-6 col-lg-3">
				<a href="details.php?category=${product['category']}&&id=${product['id']}">
					<div class="py-4 px-3 py-sm-3 px-sm-2 p-md-2 bg-white text-center">
						<div class="productImageDiv">
							<img src="${product['img']}" alt="${product['name']}" class="fittingImage">
						</div>
						<p class="productName mt-2 mb-0">${product['name']}</p>
						<span class="productNewPrice my-0 mr-2">${createCurrencyFormat(product['new_price'])}</span>
						<span class="productOldPrice my-0"><s>${createCurrencyFormat(product['old_price'])}</s></span>
						<div>
							<span>${createStars(product['stars'])}</span>
							<span class="ratings">${product['ratings']}</span>
						</div>
					</div>
				</a>
			</div>
		`);
	}
}
function createCurrencyFormat(numericString) {
    if (numericString != 0) {
        return new Intl.NumberFormat("de-DE", {style: "currency", currency: "EUR"}).format(numericString);
    } else {
        return "";
    }
}
function createStars(integer) {
    let result = '';
    if (integer > 0) {
        for (let i = 0; i < integer; i++) {
            result += '<span class="fullStar">&starf;</span>';
        }
        for (i = 0; i < 5 - integer; i++) {
            result += '<span class="emptyStar">&star;</span>';
        }
    } else {
        result = '<span class="notRated">not rated</span>';
    }
    return result;
}

// if the storage is available, get the current filtering criteria from there
if (storageIsAvailable) {
	for (let i = 0; i < sessionStorage.length; i++) {
		let key = sessionStorage.key(i);
		filteringCriteria[key] = sessionStorage.getItem(key).split(","); // decomposes a string into an array of substrings
	}
    for (property in filteringCriteria) {
    	for (element of filteringCriteria[property]) {
			for (checkbox of $(":checkbox")) {
				if (checkbox.value == element) {
					checkbox.setAttribute("checked", "checked");
					checkbox.checked = true;
				}
			}
		}
    }
} else {
    Header("Cache-Control: no-store"); // the response may not be stored in any cache; effectively, both the appearence and the real status of the checkboxes will not be as "checked", and the old filtering criteria will not be applied
}
filterProducts(filteringCriteria);

// event handlers
$(document).ready(function() {
	// filter products
	$(":checkbox").on("click", function() {
		this.toggleAttribute("checked");
		let property = this.name;
		let element = this.value;
		if ($(this).is(":checked")) {
			if (filteringCriteria[property] == null) {
				filteringCriteria[property] = [element];
			} else {
				filteringCriteria[property].push(element);
			}
			$(this).parent().css("font-weight", "400");
		} else {
			filteringCriteria[property].splice(filteringCriteria[property].indexOf(element), 1);
			if (filteringCriteria[property].length == 0) {
				delete filteringCriteria[property];
			}
			$(this).parent().css("font-weight", "300");
		}
		filterProducts(filteringCriteria);
		if (storageIsAvailable) {
			sessionStorage.clear();
			for (property in filteringCriteria) {
				sessionStorage.setItem(property, filteringCriteria[property].join()); // composes a string from the array elements
			}
		}
	});

	// sort products
	$("#sort").change(function() {
		let sortingCriteria = this.value.split(" ");
		sortProducts(sortingCriteria[0], sortingCriteria[1]);
	});

	// show and hide filter criteria in the horizontal bar
	$("#criteriaButton .less").hide();
	$("#criteriaButton").on("click", function() {
		$(this).find(".more, .less").toggle();
		$(this).toggleClass("expand");
		if ($(this).hasClass("expand")) {
			$("#criteriaBar").css("height", "auto");
		} else {
			$("#criteriaBar").css("height", "1.65rem");
		}
		checkOverflow();
	});

	// show and hide vertical bar and cards
	function observeWidth() {
		currentWidth = window.innerWidth;
		if (currentWidth < 768) {
			$("#filterBar").addClass("clickable");
		} else {
			$("#filterBar").removeClass("clickable");
			$("#filterBar").removeClass("showVerticalBar");
		}
		toggleVerticalBar();
		listenToClick();
	}
	observeWidth();
	$(window).on("resize", function() {
		observeWidth();
	});
	function listenToClick() {
		$("#filterBar").off('click');
		$(".clickable").on("click", function() {
			$(this).toggleClass("showVerticalBar");
			toggleVerticalBar();
		});
		$("#verticalBar button").off('click').on("click", function() {
			$("#filterBar").removeClass("showVerticalBar");
			toggleVerticalBar();
		});
	}
	function toggleVerticalBar() {
		if ($("#filterBar").hasClass('showVerticalBar')) {
			$("#filterBar").css("width", "100%");
			$("#filterBar span:nth-child(4)").show();
			$("#filterBar hr").hide();
			$("#sortBar").hide();
			$("#verticalBar").show();
			$("#verticalBar").next().hide();
		} else {
			$("#filterBar span:nth-child(4)").hide();
			if (currentWidth >= 768) {
				$("#filterBar").css("width", "159px");
				$("#filterBar hr").hide();
				$("#verticalBar").show();
			} else {
				$("#verticalBar").hide();
				if (currentWidth >= 576) {
					$("#filterBar").css("width", "80px");
					$("#filterBar hr").hide();
				} else {
					$("#filterBar").css("width", "100%");
					$("#filterBar hr").show();
				}
			}
			$("#sortBar").show();
			$("#verticalBar").next().show();
		}
	}

	// show and hide + and - in the vertical bar
	$("#verticalBar .sectionHeading .minus").hide();
	$("#verticalBar .sectionHeading").on("click", function() {
		$(this).find(".plus, .minus").toggle();
	});
});

$(window).on("load", function() {
	function calculateWidth() {
		let number = $("#horizontalBar > div").width() - $("#filterBar").outerWidth() - $("#criteriaButton").outerWidth() - $("#sortBar").outerWidth() - 15;
		let width = number.toString() + "px";
		$("#criteriaBar").css("width", width);
		checkLineBreak()
		checkOverflow();
	}
	calculateWidth();
	$(this).on("resize", function() {
		calculateWidth();
	});
});