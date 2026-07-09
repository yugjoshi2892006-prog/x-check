document.addEventListener("DOMContentLoaded", function () {
  const radioFullPayment = document.getElementById("radio1");
  const radioInstallment = document.getElementById("radio2");
  const emiSection = document.getElementById("emiSection");

  const emiInputs = emiSection.querySelectorAll("input");

  function toggleEmiSection() {
    if (radioInstallment.checked) {
      emiSection.style.display = "block";
      emiInputs.forEach((input) => {
        input.setAttribute("required", "required");
      });
      $("#orderForm").removeClass("was-validated");
    } else {
      emiSection.style.display = "none";
      emiInputs.forEach((input) => {
        input.removeAttribute("required", "required");
      });
      $("#orderForm").removeClass("was-validated");
    }
  }

  radioFullPayment.addEventListener("change", toggleEmiSection);
  radioInstallment.addEventListener("change", toggleEmiSection);

  toggleEmiSection();
});
document.addEventListener("DOMContentLoaded", function () {
  const radioNEwCust = document.getElementById("new_cust_form");
  const radioExeCust = document.getElementById("exe_cust_form");
  const custSection = document.getElementById("cust_section");

  function toggleCustSection() {
    if (radioExeCust.checked) {
      custSection.style.display = "block";
      $("#orderForm")
        .find("input:not([type=radio]):not([type=checkbox]), textarea, select")
        .val("");
      var form = $("#orderForm")[0];
      $(
        "#cust_Name, #ordcustomerMobile, #ordcustomerArea, #ordcustomerAddress"
      ).attr("readonly", true);

      form.classList.remove("was-validated");
    } else {
      custSection.style.display = "none";
      $("#orderForm")
        .find("input:not([type=radio]):not([type=checkbox]), textarea, select")
        .val("");
      var form = $("#orderForm")[0];
      $(
        "#cust_Name, #ordcustomerMobile, #ordcustomerArea, #ordcustomerAddress"
      ).removeAttr("readonly", true);

      form.classList.remove("was-validated");
    }
  }

  radioNEwCust.addEventListener("change", toggleCustSection);
  radioExeCust.addEventListener("change", toggleCustSection);

  toggleCustSection();
});
document.addEventListener("DOMContentLoaded", function () {
  const priceInput = document.getElementById("inputProductTags");
  const downPaymentInput = document.getElementById("dp");
  const emiDurationInput = document.getElementById("inputEmiDuration");
  const emiAmountInput = document.getElementById("inputEmiAmount");

  function calculateEmiAmount() {
    const price = parseFloat(priceInput.value);
    const downPayment = parseFloat(downPaymentInput.value) || 0;
    const duration = parseInt(emiDurationInput.value);

    if (!isNaN(price) && price > 0 && !isNaN(duration) && duration > 0) {
      const remaining = price - downPayment;
      const emiAmount = (remaining / duration).toFixed(2);
      emiAmountInput.value = emiAmount;
    } else {
      emiAmountInput.value = "";
    }
  }

  // Trigger when price, down payment or duration changes
  priceInput.addEventListener("input", calculateEmiAmount);
  downPaymentInput.addEventListener("input", calculateEmiAmount);
  emiDurationInput.addEventListener("input", calculateEmiAmount);
});


$(document).ready(function () {
  $(".catalog_qr").click(function (e) {
    e.preventDefault(); // prevent default link click
    var storeId = STORE_ID;
    var button = $(this);

    $.ajax({
      url: site_url + "admin/products/catalog_qr",
      type: "POST",
      data: { id: storeId },
      dataType: "json",
      success: function (response) {
        if (response.success && response.qr_path) {
          Swal.fire({
            icon: "success",
            title: "Your Product Catalog QR downloaded successfully!",
            showConfirmButton: false,
            timer: 1500,
          });

          // Create a temporary invisible link to auto-download
          var a = document.createElement("a");
          a.href = response.qr_path;
          a.download = "qrcode.png"; // optional: set filename
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);
        } else {
          Swal.fire({
            icon: "error",
            title: "Some error occurred!",
            text: "Please try again later.",
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Some error occurred!",
          text: "Please try again later.",
        });
      },
    });
  });
  $(document).ready(function () {
    $("#cust_id").select2({
      placeholder: "Select Customer",
      allowClear: true,
      ajax: {
        url: site_url + "admin/orders/fetch_customers_for_select",
        dataType: "json",
        delay: 250,
        data: function (params) {
          return {
            search: params.term || "",
          };
        },
        processResults: function (data) {
          return {
            results: data.map(function (customer) {
              return {
                id: customer.id,
                text: customer.name + " (" + customer.mobile + ")",
                name: customer.name,
                mobile: customer.mobile,
                customer_area: customer.customer_area,
                address: customer.address,
              };
            }),
          };
        },
        cache: false,
      },
      minimumInputLength: 1,
    });

    $("#cust_id").on("select2:select", function (e) {
      var data = e.params.data;
      $("#cust_Name").val(data.name);
      var fullMobile = data.mobile || ""; // e.g., "+91884996129"
      var iti = window.iti;

      if (!iti) {
        console.error("ITI not initialized");
        $("#ordcustomerMobile").val(fullMobile);
        $("#fullPhone").val(fullMobile);
        return;
      }

      // Normalize mobile number
      if (fullMobile && !fullMobile.startsWith("+")) {
        console.warn("Mobile number missing country code, assuming +91");
        fullMobile = "+91" + fullMobile;
      }

      
      var dialCode, number;
      var match = fullMobile.match(/^\+(\d{1,4})(\d+)/);
      if (match) {
        dialCode = match[1]; 
        number = match[2]; 

        var country = window.intlTelInputGlobals
          .getCountryData()
          .find(function (c) {
            return c.dialCode === dialCode;
          });

        if (!country) {
          for (let i = dialCode.length - 1; i > 0; i--) {
            let shorterDialCode = dialCode.substring(0, i);
            country = window.intlTelInputGlobals
              .getCountryData()
              .find(function (c) {
                return c.dialCode === shorterDialCode;
              });
            if (country) {
              dialCode = shorterDialCode; // e.g., "91"
              number = fullMobile.substring(dialCode.length + 1); // e.g., "884996129"
              break;
            }
          }
        }

        if (country) {
          iti.setCountry(country.iso2); // Set country (e.g., "in")
          iti.setNumber(fullMobile); // Let ITI format the full number
        } else {
          console.warn("Country not found for any dial code in: " + fullMobile);
          iti.setCountry("in"); // Fallback to India
          $("#ordcustomerMobile").val(number);
        }

        $("#fullPhone").val(fullMobile);
      } else {
        console.error("Invalid mobile number format: " + fullMobile);
        iti.setCountry("in");
        $("#ordcustomerMobile").val(fullMobile);
        $("#fullPhone").val(fullMobile);
      }
      $("#ordcustomerArea").val(data.customer_area);
      $("#ordcustomerAddress").val(data.address);
      $('input[name="customer_id"]').val(data.id);
    });

    $("#cust_id").on("select2:clear", function (e) {
      $("#cust_Name").val("");
      $("#ordcustomerMobile").val("");
      $("#ordcustomerArea").val("");
      $("#ordcustomerAddress").val("");
      $('input[name="customer_id"]').val("");
      $("#cust_id").val(null).trigger("change");
    });

    $("#cust_id").on("keyup", function (e) {
      var searchValue = $(this).val();
      if (e.keyCode === 8 && !searchValue) {
        $("#cust_id").empty();
        $("#cust_id").trigger("change");
        $("#cust_Name").val("");
        $("#ordcustomerMobile").val("");
        $("#ordcustomerArea").val("");
        $("#ordcustomerAddress").val("");
        $('input[name="customer_id"]').val("");
      }
    });
  });

  $("#submit_product_form").click(function (e) {
    e.preventDefault();
    var imageInput = $("#image-uploadify");
    if (imageInput.get(0).files.length === 0) {
      imageInput.addClass("is-invalid");
      imageInput.addClass("was-validated");
      return;
    } else {
      imageInput.removeClass("is-invalid").addClass("is-valid");
      imageInput.removeClass("was-validated");
    }
    var form = $("#productForm")[0];
    var formData = new FormData(form);
    $.ajax({
      url: site_url + "admin/products/add_product",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "product added successfully",
            icon: "success",
            timer: 3000,
          });
          $("#productForm")[0].reset();
        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
    });
  });
});
$(document).ready(function () {
  var input = document.querySelector("#ordcustomerMobile");
  if (input) {
    window.iti = window.intlTelInput(input, {
      initialCountry: "in",
      separateDialCode: true,
      preferredCountries: ["in", "us", "gb"],
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
    });
  } else {
    console.error("Element #ordcustomerMobile not found");
  }
  $(".saveorder").click(function (e) {
    //   alert(STORE_ID);
    //   return;
    document.querySelector('input[name="store_id"]').value = STORE_ID;

    e.preventDefault();
    var paymentType = $('input[name="customRadio"]:checked').val();

    var form = $("#orderForm")[0];
    var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);

    document.querySelector("#fullPhone").value = fullNumber;
    if (!form.checkValidity()) {
      // alert('enter in check validity')
      e.stopPropagation();
      form.classList.add("was-validated");
      return;
    }

   if (paymentType == "installment") {
  var price = parseFloat($('input[name="price"]').val()) || 0;
  var downPayment = parseFloat($('input[name="dp"]').val()) || 0;
  var emiAmount = parseFloat($('input[name="emi_amount"]').val()) || 0;
  var emiMonth = parseInt($('input[name="emi_month"]').val()) || 0;

  var totalPaid = downPayment + (emiAmount * emiMonth);
  var tolerance = 1;

  if (!emiAmount || isNaN(emiAmount)) {
    $("#inputEmiAmount").addClass("is-invalid");
  } else if (Math.abs(price - totalPaid) > tolerance) {
    $("#dp").addClass("is-invalid");
    $("#inputEmiAmount").addClass("is-invalid");
    // alert("Total of Down Payment and EMIs must match the actual price.");
  } else {
    $("#dp").removeClass("is-invalid");
    $("#inputEmiAmount").removeClass("is-invalid");
  }
}



    var formData = new FormData(form);
    console.log(formData);
    $.ajax({
      url: site_url + "admin/orders/create_order",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "product added successfully",
            icon: "success",
            timer: 3000,
          });
          $("#orderForm")[0].reset();
          $("#orderForm").removeClass("was-validated");

          $("#cust_id").val(null).trigger("change");
          location.reload();
        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
          location.reload();
        }
      },
    });
  });

  $("#customer_order").click(function () {
    const customerName = encodeURIComponent($(this).data("name"));
    window.location.href = site_url + "orders?search=" + customerName;
  });

  $(document).ready(function () {
    // alert('select trigger');

    $("#amc_id").select2({
      placeholder: "Select Customer",
      allowClear: true,
      ajax: {
        url: site_url + "admin/orders/fetch_customers_for_select",
        dataType: "json",
        delay: 250,
        data: function (params) {
          return {
            search: params.term || "",
          };
        },
        processResults: function (data) {
          return {
            results: data.map(function (customer) {
              return {
                id: customer.id,
                text: customer.name + " (" + customer.mobile + ")",
                name: customer.name,
                mobile: customer.mobile,
                customer_area: customer.customer_area,
                address: customer.address,
              };
            }),
          };
        },
        cache: false,
      },
      minimumInputLength: 1,
    });

    $("#amc_id").on("select2:select", function (e) {
      var data = e.params.data;
      $("#cust_Name").val(data.name);

      var fullMobile = data.mobile || ""; // e.g., "+91884996129"
      var iti = window.iti;

      if (!iti) {
        console.error("ITI not initialized");
        $("#amccustomerMobile").val(fullMobile);
        $("#fullPhone").val(fullMobile);
        return;
      }

      if (fullMobile && !fullMobile.startsWith("+")) {
        console.warn("Mobile number missing country code, assuming +91");
        fullMobile = "+91" + fullMobile;
      }

      // Extract dial code and national number
      var dialCode, number;
      var match = fullMobile.match(/^\+(\d{1,4})(\d+)/);
      if (match) {
        dialCode = match[1]; // e.g., "9188" (incorrect)
        number = match[2]; // e.g., "4969129"

        // Find country with the extracted dial code
        var country = window.intlTelInputGlobals
          .getCountryData()
          .find(function (c) {
            return c.dialCode === dialCode;
          });

        // If no country found, try shorter dial codes (e.g., "91" instead of "9188")
        if (!country) {
          for (let i = dialCode.length - 1; i > 0; i--) {
            let shorterDialCode = dialCode.substring(0, i);
            country = window.intlTelInputGlobals
              .getCountryData()
              .find(function (c) {
                return c.dialCode === shorterDialCode;
              });
            if (country) {
              dialCode = shorterDialCode; // e.g., "91"
              number = fullMobile.substring(dialCode.length + 1); // e.g., "884996129"
              break;
            }
          }
        }

        if (country) {
          iti.setCountry(country.iso2); // Set country (e.g., "in")
          iti.setNumber(fullMobile); // Let ITI format the full number
        } else {
          console.warn("Country not found for any dial code in: " + fullMobile);
          iti.setCountry("in"); // Fallback to India
          $("#amccustomerMobile").val(number);
        }

        $("#amcfullPhone").val(fullMobile);
      } else {
        console.error("Invalid mobile number format: " + fullMobile);
        iti.setCountry("in");
        $("#amccustomerMobile").val(fullMobile);
        $("#amcfullPhone").val(fullMobile);
      }
      $("#ordcustomerArea").val(data.customer_area);
      $("#ordcustomerAddress").val(data.address);
      $('input[name="customer_id"]').val(data.id);
    });
    $("#amc_id").on("select2:clear", function (e) {
      // Clear all related fields
      $("#cust_Name").val("");
      $("#amccustomerMobile").val("");
      $("#ordcustomerArea").val("");
      $("#ordcustomerAddress").val("");
      $('input[name="customer_id"]').val("");

      // Reset Select2 to placeholder
      $("#amc_id").val(null).trigger("change");
    });

    $("#amc_id").on("keyup", function (e) {
      var searchValue = $(this).val();
      if (e.keyCode === 8 && !searchValue) {
        $("#cust_id").empty();
        $("#cust_id").trigger("change");
        $("#cust_Name").val("");
        $("#amccustomerMobile").val("");
        $("#ordcustomerArea").val("");
        $("#ordcustomerAddress").val("");
        $('input[name="customer_id"]').val("");
      }
    });
  });
  var input = document.querySelector("#amccustomerMobile");
  if (input) {
    window.iti = window.intlTelInput(input, {
      initialCountry: "in",
      separateDialCode: true,
      preferredCountries: ["in", "us", "gb"],
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
    });
  } else {
    console.error("Element #amccustomerMobile not found");
  }
  $(".saveamc").click(function (e) {
    e.preventDefault();

    var fullNumber = iti.getNumber();
    document.querySelector("#amcfullPhone").value = fullNumber;

    var form = $("#amcForm")[0];
    var startDate = new Date($("input[name='start_date']").val());
    var endDate = new Date($("input[name='end_date']").val());
    if (!form.checkValidity()) {
      e.stopPropagation();
      form.classList.add("was-validated");
      return;
    }
    if (endDate <= startDate) {
      $("input[name='end_date']").addClass("is-invalid");
      $("input[name='end_date']")
        .next(".invalid-feedback")
        .text("The end date should be greater than start date.")
        .show();
      return;
    } else {
      $("input[name='end_date']").removeClass("is-invalid");
      $("input[name='end_date']")
        .next(".invalid-feedback")
        .text("Please enter date.")
        .hide();
    }
    var formData = new FormData(form);
    //  console.log(formData);
    $.ajax({
      url: site_url + "admin/amc/create_amc",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          // alert('response');
          Swal.fire({
            title: "Success!",
            text: "Amc added successfully",
            icon: "success",
            timer: 3000,
          });
          $("#amcForm")[0].reset();
          $("#amc_id").val(null).trigger("change");
        window.location.href = site_url + "/amc";

          location.reload();
        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
    });
  });
});
// technicians submit

var input = document.querySelector("#technicianMobile");
if (input) {
  window.iti = window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    preferredCountries: ["in", "us", "gb"],
    utilsScript:
      "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
  });
} else {
  console.error("Element #ordcustomerMobile not found");
}
$(".savetechnicians").click(function (e) {
  e.preventDefault();

  var fullNumber = iti.getNumber();
  document.querySelector("#technicianfull").value = fullNumber;

  var form = $("#techniciansForm")[0];
  if (!form.checkValidity()) {
    e.stopPropagation();
    form.classList.add("was-validated");
    return;
  }
  var formData = new FormData(form);
  //  console.log(formData);
  $.ajax({
    url: site_url + "admin/technician/create_technicians",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        Swal.fire({
          title: "Success!",
          text: "Technician added successfully",
          icon: "success",
          timer: 3000,
        });
        $("#techniciansForm")[0].reset();
      } else if (response.status == "exsits") {
        Swal.fire({
          title: "Error!",
          text: "A technician with this mobile number already exists.",
          icon: "error",
        });
      } else {
        Swal.fire({
          title: "Error!",
          text: response.message || "An error occurred.",
          icon: "error",
        });
      }
    },
  });
});

// edit technicians

// technicians submit

var input = document.querySelector("#technicianupMobile");

if (input) {
  window.iti = window.intlTelInput(input, {
    separateDialCode: true,
    utilsScript:
      "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
  });

  // DB se mobile number lena
  var phoneFromDb = input.getAttribute("data-phone");
  if (phoneFromDb) {
    iti.setNumber(phoneFromDb); // Auto-select country + fill local number
  }
}
$(".edit_tec").click(function (e) {
  e.preventDefault();
  // alert('editclick');
  var input = document.querySelector("#technicianupMobile");
  var phoneFromDb = input.getAttribute("data-phone");

  // Reinitialize or just setNumber again
  if (window.iti && phoneFromDb) {
    iti.setNumber(phoneFromDb);
  }
});

$(".edittechnicians").click(function (e) {
  e.preventDefault();
  // alert("working on");
  // return;
  var fullNumber = iti.getNumber();
  document.querySelector("#technicianupfull").value = fullNumber;

  var form = $("#techniciansupdateForm")[0];
  if (!form.checkValidity()) {
    e.stopPropagation();
    form.classList.add("was-validated");
    return;
  }
  var formData = new FormData(form);
  //  console.log(formData);
  $.ajax({
    url: site_url + "admin/technician/update_technicians",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        // alert('response');
        Swal.fire({
          title: "Success!",
          text: "Techmicians update successfully",
          icon: "success",
          timer: 3000,
        });
        // location.reload();
        window.location.href = site_url + "/technician";
      } else {
        Swal.fire({
          title: "Error!",
          text: response.message || "An error occurred.",
          icon: "error",
        });
      }
    },
  });
});

// delete techicians

$(document).on("click", ".delete-btn", function (e) {
  e.preventDefault();

  const techId = $(this).data("id");

  Swal.fire({
    title: "Are you sure?",
    text: "This will permanently delete the technician.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: site_url + "admin/technician/delete_technician", // replace with your actual URL
        type: "POST",
        data: { id: techId },
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            Swal.fire({
              title: "Deleted!",
              text: "Technician has been deleted.",
              icon: "success",
              timer: 2000,
            });

            location.reload();
          } else {
            Swal.fire({
              title: "Error!",
              text: response.message || "Failed to delete technician.",
              icon: "error",
              timer: 3000,
            });
          }
        },
        error: function () {
          Swal.fire({
            title: "Error!",
            text: "An error occurred while deleting.",
            icon: "error",
            timer: 3000,
          });
        },
      });
    }
  });
});
// delete product
$(document).on('click', '.remove_prd', function () {
    let button = $(this);
    let productId = button.data('id');

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to remove this product?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, remove it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
             button.closest('.col').remove();
              $.ajax({
                url: site_url + "admin/technician/delete_product", 
                method: 'POST',
                data: { id: productId },
                success: function (response) {
                    console.log('Product removed:', response);
                    Swal.fire("Removed!", "Product has been removed.", "success");
                    location.reload();
                },
                error: function () {
                    Swal.fire("Error", "Something went wrong.", "error");
                }
            });
        }
    });
});

$(document).on(
  "change",
  "input[type=checkbox][id^=complaintToggle]",
  function () {
    var complaintId = $(this).data("id");
    var status = $(this).prop("checked") ? 0 : 1;

    $.ajax({
      url: site_url + "admin/complaints/update_status",
      type: "POST",
      data: {
        id: complaintId,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "status updated successfully",
            icon: "success",
            timer: 3000,
          });
          // $("#productForm")[0].reset();
          location.reload();
        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error updating status:", error);
      },
    });
  }
);

// customer toggel

$(document).on(
  "change",
  "input[type=checkbox][id^=complaintcustToggle_]",
  function () {
    var complaintId = $(this).data("id");
    var status = $(this).prop("checked") ? 0 : 1;

    $.ajax({
      url: site_url + "admin/complaints/update_status_customer",
      type: "POST",
      data: {
        id: complaintId,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "status updated successfully",
            icon: "success",
            timer: 3000,
          });
          // $("#productForm")[0].reset();
          location.reload();

        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error updating status:", error);
      },
    });
  }
);
// service toggel
$(document).on(
  "change",
  "input[type=checkbox][id^=serviceToggle]",
  function () {
    var serviceId = $(this).data("id");
    var status = $(this).prop("checked") ? 1 : 0;

    $.ajax({
      url: site_url + "admin/services/update_status",
      type: "POST",
      data: {
        id: serviceId,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "status updated successfully",
            icon: "success",
            timer: 3000,
          });
          // $("#productForm")[0].reset();
          location.reload();

        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error updating status:", error);
      },
    });
  }
);
// customer service toggel
$(document).on(
  "change",
  "input[type=checkbox][id^=servicecusToggle]",
  function () {
    var servicecustId = $(this).data("id");
    var status = $(this).prop("checked") ? 1 : 0;

    $.ajax({
      url: site_url + "admin/services/update_status_customer",
      type: "POST",
      data: {
        id: servicecustId,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "status updated successfully",
            icon: "success",
            timer: 3000,
          });
          // $("#productForm")[0].reset();
          location.reload();

        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error updating status:", error);
      },
    });
  }
);
// EMI Toggel
$(document).on(
  "change",
  "input[type=checkbox][id^=emiToggle]",
  function () {
    var emiId = $(this).data("id");
    var status = $(this).prop("checked") ? 1 : 0;

    $.ajax({
      url: site_url + "admin/emi/update_emi_status",
      type: "POST",
      data: {
        id: emiId,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "status updated successfully",
            icon: "success",
            timer: 3000,
          });
          // $("#productForm")[0].reset();
          location.reload();

        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error updating status:", error);
      },
    });
  }
);
// customer emi toggel
$(document).on(
  "change",
  "input[type=checkbox][id^=emicustToggle]",
  function () {
    var emicustId = $(this).data("id");
    var status = $(this).prop("checked") ? 1 : 0;

    $.ajax({
      url: site_url + "admin/emi/update_emi_customer_status",
      type: "POST",
      data: {
        id: emicustId,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "status updated successfully",
            icon: "success",
            timer: 3000,
          });
          // $("#productForm")[0].reset();
          location.reload();

        } else {
          Swal.fire({
            title: "Error!",
            text: response.message || "An error occurred.",
            icon: "error",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error updating status:", error);
      },
    });
  }
);
// $(document).ready(function () {
//   $('.service-details [data-toggle="toggle"]').change(function () {
//     var serviceId = $(this).data("id");
//     var status = $(this).prop("checked") ? 1 : 0;

//     $.ajax({
//       url: site_url + "admin/services/update_status",
//       type: "POST",
//       data: { service_log_id: serviceId, status: status },
//       success: function (response) {
//         console.log("Response:", response);
//         console.log("response.status:", response.status);
//         console.log("Type of response:", typeof response);
//         if (response.status === "success") {
//           Swal.fire({
//             title: "Success!",
//             text: "status updated successfully",
//             icon: "success",
//             timer: 3000,
//           });
//           // $("#productForm")[0].reset();
//         } else {
//           Swal.fire({
//             title: "Error!",
//             text: response.message || "An error occurred.",
//             icon: "error",
//           });
//         }
//       },
//       error: function (xhr, status, error) {
//         console.error("Error updating status:", error);
//       },
//     });
//   });
// });
// $(document).ready(function () {
//   $('.emi-details [data-toggle="toggle"]').change(function () {
//     var $toggle = $(this);
//     var emiId = $toggle.data("id"); // EMI ID
//     var status = $toggle.prop("checked") ? 1 : 0; // 1 = Paid, 0 = Pending

//     $toggle.prop("disabled", true);

//     $.ajax({
//       url: site_url + "admin/emi/update_emi_status",
//       type: "POST",
//       data: { emi_id: emiId, status: status },
//       dataType: "json",
//       success: function (response) {
//         console.log("Response:", response);
//         console.log("response.status:", response.status);
//         if (response.status === "success") {
//           Swal.fire({
//             title: "Success!",
//             text: "EMI status updated successfully",
//             icon: "success",
//             timer: 3000,
//             timerProgressBar: true,
//           });
//         } else {
//           Swal.fire({
//             title: "Error!",
//             text: response.message || "An error occurred.",
//             icon: "error",
//           });
//         }
//       },
//       error: function (xhr, status, error) {
//         console.error("AJAX Error:", error);
//       },
//       complete: function () {
//         $toggle.prop("disabled", false);
//       },
//     });
//   });
// });

$(document).ready(function () {
  var $updateButton = $(".update_form");
  $updateButton.prop("disabled", true);

  $("input").on("input", function () {
    $updateButton.prop("disabled", false);
  });

  $updateButton.on("click", function () {
    var userId = $("#store_id").val();
    var storeName = $("#storeName").val();
    var fullName = $("#fullName").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    // var isValid = true;

    $.ajax({
      url: site_url + "admin/profile/update_profile",
      type: "POST",
      data: {
        store_id: userId,
        store_name: storeName,
        full_name: fullName,
        email: email,
        mobile: mobile,
      },
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Profile updated successfully!",
            showConfirmButton: false,
            timer: 1500,
          });
          $updateButton.prop("disabled", true);
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Error: " + response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Something went wrong!",
          text: "Please try again.",
        });
      },
    });
  });

  $("#technicians_id").on("change", function () {
    // alert('hi');
    var technicianId = $(this).val();
    var complaintId = $("#complaint_id").val();
    // alert(technicianId);
    // alert(complaintId);

    if (technicianId && complaintId) {
      $.ajax({
        url: site_url + "admin/technician/assign_to", // Replace with actual path
        type: "POST",
        data: {
          technician_id: technicianId,
          complaint_id: complaintId,
        },
        dataType: "json", // Make sure to expect JSON
        success: function (response) {
          if (response.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Assigned",
              text: response.message,
              timer: 2000,
              showConfirmButton: false,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Failed",
              text: response.message,
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
        error: function (xhr, status, error) {
          Swal.fire({
            icon: "error",
            title: "AJAX Error",
            text: error,
            showConfirmButton: true,
          });
        },
      });
    }
  });
});
// service_technicians change
$("#technicians_service_id").on("change", function () {
  // alert('hi');
  var technicianId = $(this).val();
  var complaintId = $("#service_id").val();
  // alert(technicianId);
  // alert(complaintId);

  if (technicianId && complaintId) {
    $.ajax({
      url: site_url + "admin/services/assign_to", // Replace with actual path
      type: "POST",
      data: {
        technician_id: technicianId,
        complaint_id: complaintId,
      },
      dataType: "json", // Make sure to expect JSON
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Assigned",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Failed",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "AJAX Error",
          text: error,
          showConfirmButton: true,
        });
      },
    });
  }
});

$(".pwd_change").on("click", function (e) {
  e.preventDefault();
  // alert('clcik');
  // Get input values
  var currentPassword = $("#c_pwd").val().trim();
  var newPassword = $("#n_pwd").val().trim();
  var confirmPassword = $("#c_new_password").val().trim();
  var store_id = $("#store_id").val().trim();

  var isValid = true;

  // Clear previous error messages
  $(".error-msg").text("");

  // Validation
  if (currentPassword === "") {
    $("#storeName")
      .nextAll(".error-msg")
      .first()
      .text("Current password is required.");
    isValid = false;
  }

  if (newPassword === "") {
    $("#n_pwd").nextAll(".error-msg").first().text("New password is required.");
    isValid = false;
  }

  if (confirmPassword === "") {
    $("#c_new_password")
      .nextAll(".error-msg")
      .first()
      .text("Confirm password is required.");
    isValid = false;
  } else if (newPassword !== confirmPassword) {
    $("#c_new_password")
      .nextAll(".error-msg")
      .first()
      .text("new & confirm Passwords  do not match.");
    isValid = false;
  }

  if (!isValid) {
    return;
  }

  // AJAX request (update the URL to your endpoint)
  $.ajax({
    url: site_url + "admin/profile/update_password",
    type: "POST",
    data: {
      current_password: currentPassword,
      store_id: store_id,
      new_password: newPassword,
      confirm_password: confirmPassword,
    },
    success: function (response) {
      if (response.status === "success") {
        Swal.fire({
          icon: "success",
          title: response.message || "Password updated successfully!",
          showConfirmButton: false,
          timer: 1500,
        });
        $("#current_password").val("");
        $("#new_password").val("");
        $("#c_new_password").val("");
      } else if (response.status === "invalid") {
        // alert('enter in invalid');
        Swal.fire({
          icon: "error",
          title: "Invalid Password",
          text:"The current password is incorrect.",
        });
      } else {
        // alert('enter in falid');

        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.message || "Failed to update password.",
        });
      }
    },
    error: function () {
      Swal.fire({
        icon: "error",
        title: "Oops!",
        text: "Something went wrong. Please try again.",
      });
    },
  });
});
const fileInput = document.getElementById("image-uploadify");
const imagePreview = document.getElementById("image-preview");

fileInput.addEventListener("change", function (event) {
  const file = event.target.files[0];

  if (file) {
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();

      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = "block";
      };

      reader.readAsDataURL(file);
    } else {
      imagePreview.style.display = "none";
      imagePreview.src = "";
      alert("Please select a valid image file.");
    }
  } else {
    imagePreview.style.display = "none";
    imagePreview.src = "";
  }
});
