<?php

return [

<<<<<<< HEAD
    'undeployable' 		=> '<strong>Warning: </strong> This asset has been marked as currently undeployable. If this status has changed, please update the asset status.',
    'does_not_exist' 	=> 'Aset tidak ada.',
    'does_not_exist_var'=> 'Asset with tag :asset_tag not found.',
    'no_tag' 	        => 'No asset tag provided.',
    'does_not_exist_or_not_requestable' => 'That asset does not exist or is not requestable.',
    'assoc_users'	 	=> 'Aset ini saat ini diperiksa ke pengguna dan tidak dapat dihapus. Harap periksa dulu asetnya, lalu coba hapus lagi. ',
    'warning_audit_date_mismatch' 	=> 'This asset\'s next audit date (:next_audit_date) is before the last audit date (:last_audit_date). Please update the next audit date.',
=======
    'undeployable' 		=> '<strong>Peringatan:</strong>Aset ini telah ditandai karena saat ini tidak dapat dipasangkan lagi. Jika status ini telah berubah, harap perbarui status aset.',
    'does_not_exist' 	=> 'Aset tidak ada.',
    'does_not_exist_or_not_requestable' => 'That asset does not exist or is not requestable.',
    'assoc_users'	 	=> 'Aset ini saat ini diperiksa ke pengguna dan tidak dapat dihapus. Harap periksa dulu asetnya, lalu coba hapus lagi. ',
>>>>>>> 64747d0fb (updates based on review)

    'create' => [
        'error'   		=> 'Aset tidak dibuat, coba lagi. :(',
        'success' 		=> 'Aset berhasil dibuat. :)',
<<<<<<< HEAD
        'success_linked' => 'Asset with tag :tag was created successfully. <strong><a href=":link" style="color: white;">Click here to view</a></strong>.',
=======
>>>>>>> 64747d0fb (updates based on review)
    ],

    'update' => [
        'error'   			=> 'Aset tidak diperbarui, coba lagi',
        'success' 			=> 'Aset Berhasil diperbarui.',
<<<<<<< HEAD
        'encrypted_warning' => 'Asset updated successfully, but encrypted custom fields were not due to permissions',
        'nothing_updated'	=>  'Tidak ada kategori yang dipilih, jadi tidak ada yang diperbarui.',
        'no_assets_selected'  =>  'No assets were selected, so nothing was updated.',
        'assets_do_not_exist_or_are_invalid' => 'Selected assets cannot be updated.',
=======
        'nothing_updated'	=>  'Tidak ada kategori yang dipilih, jadi tidak ada yang diperbarui.',
>>>>>>> 64747d0fb (updates based on review)
    ],

    'restore' => [
        'error'   		=> 'Aset tidak dikembalikan, coba lagi',
        'success' 		=> 'Aset Berhasil dikembalikan.',
<<<<<<< HEAD
        'bulk_success' 		=> 'Aset Berhasil dikembalikan.',
        'nothing_updated'   => 'No assets were selected, so nothing was restored.', 
    ],

    'audit' => [
        'error'   		=> 'Asset audit unsuccessful: :error ',
=======
    ],

    'audit' => [
        'error'   		=> 'Audit aset tidak berhasil. Silahkan coba lagi.',
>>>>>>> 64747d0fb (updates based on review)
        'success' 		=> 'Audit aset berhasil dimasuki.',
    ],


    'deletefile' => [
        'error'   => 'Berkas tidak terhapus. Silahkan coba lagi.',
        'success' => 'File berhasil dihapus.',
    ],

    'upload' => [
        'error'   => 'Berkas(s) tidak diunggah. Silahkan coba lagi.',
        'success' => 'Berkas(s) berhasil diunggah.',
        'nofiles' => 'Anda tidak memilih file untuk diunggah, atau file yang ingin Anda unggah terlalu besar',
        'invalidfiles' => 'Satu atau lebih berkas anda terlalu besar atau jenis berkas tidak dibolehkan. Jenis berkas yang dibolehkan adalah png, gif, jpg, doc, docx, pdf, dan txt.',
    ],

    'import' => [
<<<<<<< HEAD
        'import_button'         => 'Process Import',
=======
>>>>>>> 64747d0fb (updates based on review)
        'error'                 => 'Beberapa item tidak diimpor dengan benar.',
        'errorDetail'           => 'Item berikut tidak diimpor karena kesalahan.',
        'success'               => 'File Anda telah diimpor',
        'file_delete_success'   => 'File anda telah berhasil dihapus',
        'file_delete_error'      => 'File tidak dapat dihapus',
<<<<<<< HEAD
        'file_missing' => 'The file selected is missing',
        'header_row_has_malformed_characters' => 'One or more attributes in the header row contain malformed UTF-8 characters',
        'content_row_has_malformed_characters' => 'One or more attributes in the first row of content contain malformed UTF-8 characters',
=======
>>>>>>> 64747d0fb (updates based on review)
    ],


    'delete' => [
        'confirm'   	=> 'Yakin ingin menghapus aset ini?',
        'error'   		=> 'Terjadi masalah saat menghapus aset. Silahkan coba lagi.',
        'nothing_updated'   => 'Tidak ada aset yang dipilih, jadi tidak ada yang diperbarui.',
        'success' 		=> 'Aset berhasil dihapus.',
    ],

    'checkout' => [
        'error'   		=> 'Aset tidak dapat diperiksa, silahkan coba lagi',
        'success' 		=> 'Aset berhasil diperiksa.',
        'user_does_not_exist' => 'Pengguna tidak cocok. Silahkan coba lagi.',
        'not_available' => 'Aset itu tersebut tidak tersedia untuk checkout!',
        'no_assets_selected' => 'Anda harus memilih setidaknya satu aset dari daftar',
    ],

    'checkin' => [
        'error'   		=> 'Aset tidak dicek, coba lagi',
        'success' 		=> 'Aset berhasil dicek.',
        'user_does_not_exist' => 'Pengguna tidak cocok. Silahkan coba lagi.',
        'already_checked_in'  => 'Aset tersebut sudah diperiksa.',

    ],

    'requests' => [
        'error'   		=> 'Aset tidak dikembalikan, coba lagi',
        'success' 		=> 'Aset Berhasil dikembalikan.',
        'canceled'      => 'Permintaan checkout berhasil dibatalkan',
    ],

];
