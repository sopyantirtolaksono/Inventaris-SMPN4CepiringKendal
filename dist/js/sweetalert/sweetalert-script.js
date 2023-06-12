// sweetalert 2

$(document).ready(function() {

	// modal alert hapus data
	// $("button#btn-hapus-stok").on("click", function(e) {

	// 	const jmlHapusStok = $("input[name='jumlah_hapus_stok']").val();
	// 	const ketHapusStok = $("textarea[name='keterangan_hapus_stok']").val();

	// 	e.preventDefault();

	// 	const form = $("form#form-hapus-stok");
	// 	const action = $("form#form-hapus-stok").attr("action");

	// 	Swal.fire({
	// 		icon: "warning",
	// 		title: "Yakin hapus stok ini?",
	// 		showCancelButton: true,
	// 		showDenyButton: true,
	// 		confirmButtonText: "OK",
	// 		denyButtonText: "Batal"
	// 	}).then(result => {
	// 	  if(result.isConfirmed) {

	// 	  	form.submit(function() {
	// 	  		$.ajax({
	// 	  			type: "POST",
	// 	  			url: form.attr("action"),
	// 	  			data: form.serialize(),
	// 	  			dataType: "json",
	// 	  			success: function(response) {
	// 	  				console.log("Sukses!");
	// 	  			},
	// 	  			error: function(response) {
	// 	  				console.log("Gagal!")
	// 	  			}
	// 	  		});
	// 	  	});
		  	
	// 	  }
	// 	  else if(result.isDenied) {
	// 	  	e.preventDefault();
	// 	  }
	// 	})

	// });

	// modal alert keluar
	$("a#link-logout").on("click", function(e) {
		e.preventDefault();

		const href = $(this).attr("href");

		Swal.fire({
			icon:  "question",
			title: "Yakin ingin keluar",
			showCancelButton: true,
			confirmButtonText: "OK"
		}).then((result) => {
			if(result.value) {
				document.location.href = href;
			}
		})

	});

});

// akhir sweetalert 2