const dropArea = document.getElementById('drop-area');
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropArea.classList.add('highlight');
}

function unhighlight(e) {
    dropArea.classList.remove('highlight');
}

dropArea.addEventListener('drop', dropHandler, false);

function dropHandler(ev) {
    console.log('File(s) dropped');
    const dT = new DataTransfer();
  
    // Prevent default behavior (Prevent file from being opened)
    ev.preventDefault();
  
    if (ev.dataTransfer.items) {
        dT.items.add(new File(ev.dataTransfer.files, ev.dataTransfer.files.item(0).name));
        document.getElementById('flyer').files = dT.files;
    }
  }

// function handleDrop(e) {
//     let dt = e.dataTransfer;
//     let files = dt.files;

//     handleFiles(files);
//     // uploadFile(files);
// }

// function handleFiles(files) {
//     ([...files]).forEach(uploadFile);
// }

// // function uploadFile(file) {
// //     const url = '/scripts/uploadFlyer.php';
// //     let formData = new FormData();

// //     formData.append('file', file);

// //     fetch(url, {
// //         method: 'POST',
// //         body: formData,
// //     })
// //     .then(res => {console.log(res)})
// //     .catch(err => {console.log('error')});
// // }

// function uploadFile(file) {
//     console.log(file);
//     let formD = new FormData();
//     formD.append('file', file);

//     $.ajax({
//         type: "POST",
//         url: 'scripts/uploadFlyer.php',
//         data: formD,
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(response)
//         {
//             console.log(response);
//         },
//         error: function(response)
//         {
//             console.log("Error: " + response);
//         }
//     });
// }