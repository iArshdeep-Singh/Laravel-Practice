
$(document).ready(function () {
    // index
    function fetchData() {
        $.ajax({
            url: "{{route('/')}}",
            method: "GET",
            success: function (data) {

                console.log(data)
                let html = ''

                data.forEach(d => {
                    html += `
                            <tr>
                                <td>${d.id}</td>
                                <td>${d.name}</td>
                                <td>${d.email}</td>
                                <td>${d.salary}</td>
                                <td>
                                    <button class="edit-btn" data-id="${d.id}">Edit</button>
                                    <button class="delete-btn" data-id="${d.id}">Delete</button>
                                </td>
                            </tr>`
                });

                $('#emplyees-table tbody').html(html)

            }
        })
    }

    fetchData()
})



// document.addEventListener('DOMContentLoaded', function () {
//     // Function to fetch data
//     function fetchData() {
//         fetch("{{route('employee.index')}}", {
//             method: "GET"
//         })
//             .then(response => response.json())
//             .then(data => {
//                 let html = '';

//                 data.forEach(d => {
//                     html += `
//                     <tr>
//                         <td>${d.id}</td>
//                         <td>${d.name}</td>
//                         <td>${d.email}</td>
//                         <td>${d.salary}</td>
//                         <td>
//                             <button class="edit-btn" data-id="${d.id}">Edit</button>
//                             <button class="delete-btn" data-id="${d.id}">Delete</button>
//                         </td>
//                     </tr>`;
//                 });

//                 // Insert the data into the table
//                 document.querySelector('#emplyees-table tbody').innerHTML = html;
//             })
//             .catch(error => console.error('Error fetching data:', error));
//     }

//     // Call fetchData to load the data on page load
//     fetchData();
// });
