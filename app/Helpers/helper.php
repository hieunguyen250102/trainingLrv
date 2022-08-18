<?php

function renderTable($faculties)
{
    $html = '';

    foreach ($faculties as $key => $faculty) {

        $html .= '
                    <tr id="id' . $faculty->id . '">
                    <th scope="row">' . $faculty->id . '</th>
                    <td>' . $faculty->name . '</td>
                    <td>
                        <a onclick="update(' . $faculty->id . ')" data-bs-toggle="modal" data-bs-target="#edit-bookmark" id="editFaculty" data-id="' . $faculty->id . '">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="' . route('faculties.destroy', ['faculty' => $faculty->id]) . '" class="btn btn-danger btnDelete">Delete</a>
                    </td>
                </tr>
                ';
    }

    return $html;
}

    // if (!function_exists('renderTable')) {
    //     function renderTable(array $theader, $model, $image = null)
    //     {
    //         $countTag = [];
    //         foreach ($model as $key => $value) {
    //             $countTag[] = $key;
    //             foreach ($countTag as $tag) {

    //             }
    //         }
    //     }
    // }
