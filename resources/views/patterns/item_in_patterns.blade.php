<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Colorset</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- css -->
        <link href="/css/header.css" rel="stylesheet">
        <link href="/css/all_patterns_layout.css" rel="stylesheet">
        <link href="/css/loading.css" rel="stylesheet">
    </head>
    <header class="header_inline_block">
        <h1>Colorset</h1>
        <nav>
            <ul>
                <li><h1><a href="{{ route('profile.edit') }}">PROFILE</a></h1></li>
                <li><h1><a href="/cloths/items">ITEMS</a></h1></li>
                <li><h1><a href="/cloths/patterns">PATTERNS</a></h1></li>
            </ul>
        </nav>
    </header>
    <body>
        <div id="loading">
            Loading...
        </div>
        <div class="body">
            <div class="patterns_and_add">
                <h2>ALL PATTERNS</h2>
                <div class='add'>
                    <h3><a href="{{ route("add_pattern") }}">ADD+</a></h3>
                </div>    
            </div>
            <div class='patterns'>
                <div class="BackMenuButton">
                    <div class="hover_behavior" id="backmenubuttoncontainer">
                        ←Back<br>
                    </div>
                    <a id="backmenulink" href="/cloths/items" style="display: none;"></a>
                </div>
                <div class='patterns_photo'>
                    @foreach($coordinations as $coordination)
                        <div class='pattern'>
                            <img class="patterns_img" src={{ $coordination->coordinations_img }}>
                            <?php
                             $item_colors = array('tops_color' => $coordination->tops_color_id, 'botoms_color' => $coordination->botoms_color_id, 'shoes_color' => $coordination->shoes_color_id);
                             foreach ($item_colors as $item_color => $item_color_id) {
                                if ($item_color_id == 1){
                                    $item_colors[$item_color] = "#2C72B0";
                                } else if ($item_color_id == 2){
                                    $item_colors[$item_color] = "#0A96BA";
                                } else if ($item_color_id == 3){
                                    $item_colors[$item_color] = "#018D5C";
                                } else if ($item_color_id == 4){
                                    $item_colors[$item_color] = "#8BBA2C";
                                } else if ($item_color_id == 5){
                                    $item_colors[$item_color] = "#F4E41B";
                                } else if ($item_color_id == 6){
                                    $item_colors[$item_color] = "#FBC51B";
                                } else if ($item_color_id == 7){
                                    $item_colors[$item_color] = "#F18C20";
                                } else if ($item_color_id == 8){
                                    $item_colors[$item_color] = "#EA6021";
                                } else if ($item_color_id == 9){
                                    $item_colors[$item_color] = "#E12323";
                                } else if ($item_color_id == 10){
                                    $item_colors[$item_color] = "#C3087B";
                                } else if ($item_color_id == 11){
                                    $item_colors[$item_color] = "#6D398B";
                                } else if ($item_color_id == 12){
                                    $item_colors[$item_color] = "#454D98";
                                } else if ($item_color_id == 13){
                                    $item_colors[$item_color] = "black";
                                } else if ($item_color_id == 14){
                                    $item_colors[$item_color] = "gray";
                                } else if ($item_color_id == 15){
                                    $item_colors[$item_color] = "white";
                                }
                             }
                            ?>
                            <span class="tops_item_color" style=background-color:{{ $item_colors['tops_color'] }};></span>
                            <span class="botoms_item_color" style=background-color:{{ $item_colors['botoms_color'] }};></span>
                            <span class="shoes_item_color" style=background-color:{{ $item_colors['shoes_color'] }};></span>
                            <form class="edit_patterns_button_frame" action="/cloths/patterns/edit_patterns/{{ $coordination->id }}" method="GET">
                                @csrf
                                <input type="hidden" name="id" value="{{ $coordination->id }}">
                                <button type="submit">
                                    <img class="edit_patterns_button_img" src="data:image/png;base64,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">
                                </button>
                            </form>
                            <form class="delete_patterns_button_frame" action="/cloths/patterns/delete_patterns/{{$coordination->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <img class="delete_patterns_button_img" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAYAAABccqhmAAAAAXNSR0IArs4c6QAAIABJREFUeF7tXQuUXWV13vucmRqDJbhaEKQPNFZitVq1LYSEGjAk957/3CE8UroKykPALrusj5JWu7S8VNqGqmh1VUh5KHSVlQDh3n+fexMejprwaEWrtVXUUNpVGh7tklAIsTP37M4/ORNmkrlzz7n3vM8+a81iyOx/P769z3f//7//A0GewiOwZs2awxYtWrS02+0ew8xLLMtawsyHA8ASRDz49yUAcHjw7+Z3QMQ9zLwHAJ6b9fseRHwu+Pfp333fN//dY9v27n379u3avn37C4UHr+IBYMXjL0z49Xr9yJGRkaXMfOAHEZcCgPk5OqNAngSAXcy8CxEP/ExOTu5qt9vPZOSTmI2AgBBABLDSEG00Gou73e6piLjSvNzmJTcvvfnUTsN+jDZMb2KaHAKS2GHb9v2tVmtvjDZE1ZAICAEMCWAMzdF13RW+769CxNMA4Ldj0JlnFV9n5nssyxrXWu8EAM6zs2X3TQgggwwrpd4OACcFL7t56afH4hV8zLzDPQDwdQB4gIgeqSAGmYYsBJAC/Eqp1yLiqVOffCsAwHTtX5eC2SKa+DEA7JjqCe1k5vuJ6LEiBlEkn4UAEsrWunXrjpicnBwDgDFmNv8dTchUWdVOIGITAJojIyPNrVu3PlvWQLOMSwggZvQdx3ERcfrFB4BXxay+quqeMkTAzE3P83RVQUgibiGAGFB1XXc5M58evPRviEGlqOiNwPcNGSDi3VrrBwWo4RAQAhgQv1qtdrxlWWPBp70Z18uTPgI7TK/A9/1mp9N5NH3zxbcoBBAxh47jnGBZ1sXMfHHEpiKeIAKIuMn3/U2e5z2coJnSqRYCCJnSer2+wrz4AHBByCYilg0CNxsiaLfbZo2BPH0QEALoA5DruquCT/tzpZoKhcBtplegtR4vlNcpOysE0ANwpdRqRDRd/XNSzomYixEBRLydmTcR0b0xqi2NKiGAg1JZr9frQVf/zNJkWQIxCNwZDA3aAsdLCAgBBFg4jmOW5L4fERtSIOVFgJlbAPB5z/PMEuTKP5UngFqtdpxt2xsA4H2Vr4ZqAfDFbre7sdPpPF6tsOdGW2kCcF33A8xsXv5jq1wEFY79CUTcqLW+rqoYVJIAXNd1ghd/VVUTL3HPQWA8IAKvarhUigDGxsZe1+12zSf+pVVLtMQbCoHrbdve2Gw2za7ESjyVIQCl1GXmUx8Rj6pEZiXIgRBg5qdNb4CIrh1IQcEalZ4AlFJmV5751Jf1+gUrzozd3QEAhgjMluTSPqUmAMdxLkfEK0qbPQkscQSY+QrP865M3FBGBkpJAPV6fallWRsB4IyMcBWz5ULgLt/3N7TbbXPAaame0hGA67pnMLN5+c1JuvIIAnEhYI4936C1visuhXnQUyoCkC5/Hkqq3D4w85We55VmWFkKApAuf7lfuhxGV5ohQeEJQLr8OXw9quFSKYYEhSYAx3GuQMTLq1FvEmUeESj6kKCQBGAuwxwZGbkFEc/KY1GIT9VCgJnvmJycPL+Il6UWjgDWrl17zMjIyN8BgKzjr9Z7lvdoxycnJ39v27Ztu/Pu6Gz/CkUAjUZjme/7mwHgTUUCWXytDALfsyxrfavV+kFRIi4MAZjTeBHRfAd7TFHAFT8ricBuZj6jKKcTF4IAzGk9iEhyvVYlX6giBj3BzKoIpw7lngBc1z2bmU23Xx5BoFAIIOJ6rfWWPDudawJQSl0EAH+bZwDFN0GgDwLvIaIb84pSbgnAcZwPIeKn8wqc+CUIhEWAmT/sed5nwsqnKZdLApA1/WmWgNhKA4G8LhjKHQG4rnshM+e2y5RGsYiNciKAiBdprW/KU3S5IgDXdd/JzHKDS54qRHyJFQFEXK21vi9WpUMoyw0BBN/zPzRELNJUECgEAsx8Yl7WCeSCAGq12ptt2/5OIbInTgoCMSDQ7Xbf0ul0vhuDqqFUZE4AwVHd/wwAi4aKRBoLAsVCYJ9t27+W9RHkmRLA2NjYq7vd7lcB4PXFyp14KwjEgsAPbds+pdls/lcs2gZQkhkBKKVeCQB3AMApA/gtTQSBsiBgPgDPIqKfZBFQJgRQr9dfZlmWeflVFkGLTUEgZwiQ7/tntdvtn6btVyYEoJQya/vPTjtYsScI5BiBLUS0Pm3/UicAOcYr7RSLvaIgkMVqwVQJIDjA886iJET8FATSRgARz0zz7oHUCCA4unubXNiRdkmJvYIhsMv3/bVp3UKUGgEopcwnv1zVVbBqFHczQeAuIjozDcupEICM+9NIpdgoEwJpzQckTgAy7i9TWUosaSKQxnxAogQg4/40y0VslRCBxOcDEiUAGfeXsCQlpLQRSHQ+IDECkHF/2nUi9sqKQJLzAYkQgFJqDADuLmtCJC5BIAMETieiZtx2kyKAbwDAyridFX09ETBLqzcj4jNpYMTMRwKAWbaa+tLVNOLLqY0dRHRy3L7FTgBKqcsAYGPcjoq+ngg0iej0LPBRSplenuntyZMOAhuI6No4TcVKAOZwj8nJyZ2IeFScToqu3gj4vr+y3W7vzAKjer2+wrKsHVnYrqJNZn56ZGRkRZyHiMRKAEqpLwHApVVMTkYxP0ZESzOyPW1WKbULAF6bpQ8Vs309Eb03rphjIwDXdR1mNvf3yZMeAuNElOmBKkopc6CFXNWeXs4BEZXW2ovDZGwEIIUQRzoi6/gsEX0ocqsYGyilzI03H4xRpajqj0BsxB8LAbiu+wFm/mx/v0UiZgQyv3dO7m+MOaMh1SHiB7XW14UU7yk2NAHUarXjbNs2E0HHDuuMtI+GQJYTgDOeykRgtJzFKP1Et9td2el0Hh9G59AEoJT6AgC8bxgnpO1gCFiWdWSr1frvwVrH06rRaPy87/uprD+Ix+NSafkiEf3BMBENRQCO45yGiNuHcUDaDoxArLPBA3ux/5sA+fZnGACHaMvMazzPu2dQFcMSQBMRG4Mal3ZDIfAbRPTIUBpiaqyUejsAfDMmdaImAgLM3PI8b+DFWAMTQL1er1uWFctXERHiFdH9COTm038mIdILyK40fd932u12exAPBiYApZQ51z+VY4sGCazEbR60LOuiVqv1gzzF2Gg0lvm+b651X54nvyriy51EdNYgsQ5EAEqp1QAw8LhjEEelzTQCt1qW9d5Wq7U3j3g0Go3Fvu+b+YDz8uhfyX06jYjujRrjQATguu7fM/M5UY2J/MAIPIOIm7TWfzqwhhQbuq77KWa+GADMrkF5UkAAEW/XWv9uVFORCcB13VXMbJZ/lvkZz0lwjzDzvXv37r13fHx8Mic+hXJj1apVI4sXL16NiKa3aCYJ8/CUeskyIp6itY5Uu5EJQCl1KwCcm4dsJuXDIEAm5YvojQeBinxw3UZEkYZfkQigKqu+hADieenypKUiBABRV4dGIgCl1E0AcEGeEpuEL0IASaCarc6qEAAA3ExEF4ZFOzQBOI5zAiI+FFZxkeWEAIqcvfl9rxABADOf6Hnew2GyGJoAXNe9IZjZDaO30DJCAIVO37zOV4kAgm+MLgmTxVAEUKvVjrdtO1cLT8IEN6iMEMCgyOW3XZUIwGSh2+0u63Q6j/bLSCgCcBxnAyL+ZT9lZfm7EEBZMvlSHFUjAGb+Y8/z+h7OG4oAlFKVOuZbCEAIoAQIhDpGvC8BuK67fGrL4QMlACR0CEIAoaEqjGDVegAmMVNb9U/SWj+4UJL6EoBS6s8B4E8Kk+kYHBUCiAHEnKmoIgEAwF8Q0UeGJYB/BYA35CyfibojBJAovJkorygBfJ+IfnVgAnAcx0XEViYZy9CoEECG4CdkuqIEYNYENDzP071gXXAIoJS6HgBCfZ+YUN4yUWtuYw0MsxlKZeJEOkbLHt8cFBHx8nRgzZWVG4io52U9PYt73bp1R0xMTJjv/l+Vq3DEGUFAEIiCwFOjo6PLtm7d+ux8jXoSgOu672bmW6JYEllBQBDIHwKIeL7W+stRCWALMw90zFD+IBCPBIHqIoCId2itzw5NAEopc9mj6f6PVhc2iVwQKA0CEwCwjIgeOziieYcASikzaWDOdpNHEBAEyoHAe4nITOrPeXoRwFfkYMdyZF2iEAQCBG4loneFJYB/mzpY4DiBThAQBEqDwONE9Jq+BFDFtf+lSbEEIggsgMB8ewMOGQI4jvMRRLxGkJwfAVklmN/KqOpqv7AZYeaPep5n9vYceA4hAKUUAYATVmnV5IQA8ptxIYC+ufGISC1EAKiU2gMAP9tXVUUFhADym3ghgL65+V8iWgIAZgn49DOnByBXfvUF0Oyxjnz5Qn+tIhEHAkIAoVCcc4XYHAJwHOdTiPjRUGoqKiQEkN/ECwH0zw0zX+N53oEr5g7uAZhjv0/or6a6EkIA+c29EECo3DxMRCceMgRYs2bNYaOjo8+HUlFhISGA/CZfCCBcbiYmJl6xffv2F+bMASilxgDg7nAqqislBJDf3AsBhM7N6UTUPJgAKnf2X2i4ZgkKAQyCWjpthABC43zgrMADcwBKqc0AMO+WwdBqKyAoBJDfJAsBhM7NFiJaP6cH4Lrut5j5raFVVFRQCCC/iRcCCJcbRPy21vptBw8BzAKgw8OpqK6UEEB+cy8EEDo3zwULgvYvBKrX60dalvV06OYVFhQCyG/yhQDC58b3/aPa7fYz0wTQaDRO9H1/wRtEwqsut6QQQH7zKwQQPjeWZS1vtVoPTROA67rnMvOt4ZtXV1IIIL+5FwIInxtEPE9rfds0ASil/mxqX8DMWfjhtVRQUgggv0kXAoiUm8uJ6KppAnAc5xZEfHek5hUVTosA1q9f/4oXX3zxJGZ+kYjM7cyxPY7jHM3Mx0zPAiPu9jzvydiUz1KklDoZEV/+/PPPPzA+Pp74KlMhgPBZZOYve553/kwPYAcArAjfvLqSSRPA2NjY8d1u12zIOv8glP/K9/2r2u32c4OiH+i+CQCWH6TjQdu2L2w2m48OqnumXb1eP9yyLNOj/KODdN1i2/Y1cdjo5aMQQKTs7SSilTMEsBsAjo7UvKLCSRJAvV4/1bKsexe4juw/fN9f0W63/zMq/LVa7Tjbts1Zjz2fbrf7mk6n83hU3TPyruseG1wl/0s9dLDv+6vb7fb9g9pYqJ0QQCRUnySiY1A2AUUCLdHzAJRS/w4AvV6eGUdvIaILoni9fv36n9m7d+9XAeCkPu0eWLx48SmbN2/+vyj6Z2SVUqZ30c+3/yCiXx5Ef782QgD9EJr7d7MpCMfGxt7c7Xa/E61pdaWT6gEopdYCQCcMsr7v/2KUXoBS6j0AsCmMbgA4i4juDCl7QGxsbOzV3W73iZDtakS0LaRsaDEhgNBQTQvatv0WcwRY6MKLpr6c0gkSwKcB4ENhUGPmCz3PuzmMrJFRSplLXnreEDtbDyK+X2v912F1z/r0N3MWYX36DBF9OKqNfvJCAP0QOuTvNXQc53cQ8fbITSvaIEEC2A4Ap4WBFRE/obX+eBjZgABM939VGHlzNbrneVeEkZ0to5S6CgDC+nQPEa2JaqOfvBBAP4Tm/p2Zz0HXdS9h5kOuDIqmqjrSSRGA4zhNRGyEQbLoBMDMLc/zzPkTsT5CANHgRMRLzRDAfF1zbbSm1ZUWApg/91F6AEIAuXl/LjMEEKXrlhvPs3JECEAIIKvaS8Du1WYIcB0z/2ECykupUghACKAshY2InzM9gDDf3ZYl5qHjEAIQAhi6iPKj4GZDAOY73zPy41O+PRECEALId4VG8u4uMwS4j5lPjdSswsJCAEIAZSl/RLzf9AC+CQBvL0tQScchBCAEkHSNpaj/EUMAPwSAX0nRaKFNCQEIARS6gOc6/yMzBHiKmY8qUVCJhiIEIASQaIGlqBwRnzY9gH0A8LIU7RbalBCAEEChC3iu8z8VAoiYTSEAIYCIJZNn8Z/KECBieoQAhAAilkxuxWeGADIJGCFFQgBCABHKJe+iP5KvASOmSAhACCBiyeRZ/BFZCBQxPUIAQgARSya34jMLgWQpcIQUCQEIAUQol7yL3iWbgSKmSAhACCBiyeRZ/GbZDhwxPUIAQgARSya34jPbgeVAkAgpEgIQAohQLnkXvVqOBIuYIiEAIYCIJZNn8cvkUNCI6RECEAKIWDK5FZ8+FFSOBY+WHyEAIYBoFZNf6eljweVikGgJEgIQAohWMbmWrsnVYBHzIwQgBBCxZHIrPn01mFwOGi0/QgBCANEqJr/S05eDGveUUnI9eMg8CQEIAYQslbyL7b8ePCCAHQCwIu8e58E/IQAhgDzUYQw+7CSildME4DjOLYj47hiUll6FEIAQQBmKnJm/7Hne+TM9gD8DgCvLEFjSMQgBCAEkXWMp6b+ciK6aJgDXdc9l5ltTMlxoM0IAQgCFLuDAeUQ8T2t92zQBNBqNE33ff7AMgSUdgxCAEEDSNZaGfsuylrdarYemCaBerx9pWdbTaRguug0hACGAotew8d/3/aPa7fYz0wRgHqXUHgA4vAzBJRmDEIAQQJL1lZLu54hoibF1gABc1/0WM781JQcKa0YIQAigsMX70vj/21rrt80hAKXUZgA4u+jBJe2/EIAQQNI1loL+LUS0/mAC+HMA+JMUjBfahBCAEEChC3i/839BRB+ZQwCO47iI2CpBcImGIAQgBJBogaWgnJkbnufpOQTQaDQW+77/Qgr2C21CCEAIoNAFDACWZR3WarX2ziEA8z9Kqa8BwG8XPcAk/RcCEAJIsr5S0P11InrHjJ0D3wKYf3Ac52OIeHUKThTWhBCAEEBhixcAmPnjnud9Yl4CcF13JTN/o8gBJu27EIAQQNI1lqR+RDxZa212/04/c3oA5v+VUj8BgOlFAvIcioAQgBBAgd+LPUT0StMR6EUAZh5A1gMskGEhACGAAhPAge//FyKA9wPA5wocZKKuCwEIASRaYMkq/0Mi+vxsEwcPAUwP4O1TO4S/mawfxdUuBCAEUNzqhd8gokcWJADzR6XUjwDgdQUONDHXhQCEABIrrmQV/5iIfuVgE4f0AAICuAkALkjWn2JqFwIQAihm5cLNRHRhKAJwXfdiZr6hoIEm6rYQgBBAogWWkHJEvERrvSkUASilXgsAPwCA0YT8KaxaIQAhgAIW7wQALCOix0IRgBFyXXcLM59VwGATdVkIQAgg0QJLQDki3qG1nner/7xzAAEBvJuZb0nAn0KrFAIQAihaASPi+VrrL8/nd08CWLdu3RETExNmGPCqogWcpL9CAEIASdZXArqfGh0dXbZ169ZnIxGAEVZKXQ8AlyTgVGFVCgEIARSseG8gokt7+dyzB2AayCEhh8KWBwKYmpz9JBF9LGwhKqW+CgCrwsgz85We510RRna2jOu6VzNzKJ+YueV53lhUG/3kXdddxcwmVnkCBGYf/hG5BxD0Av4VAN4giO5HoB+gg+KklDI3M5kbmvo+iLhea72lr2Ag4DjOFYh4eRh5RLxIa23WgUR6HMc5CxHD+nQVEYXyJ4oT8oF1CFrfJ6JfXQjDBXsAAQHIWYGzEGTmSzzPO+T71CiFOp9so9H4Td/3/yGMnsWLFy/evHnzi2FkjYzrumcw851h5Kd8cNrtdjuM7GyZVatWLTrssMNC+dTtdn+r0+n8Y1Qb/eQdx7kYEWX9yktAHTj7rxd2fQnAdd3lzPxAP/Cr8ndE/LjW+sCBCnHGrZQyL+kZC+lk5ms8z/vTqHZDDgPGieiUqLpn5JVSnwSAfr7dRURnDmpjoXau636MmeVAmwAkRDxJa73gjV99CSDoBZhDQlYmkbQC6vwiEf1BEn7X6/WllmVtBYA39dDfIaL6oLaVUj8GgKU92u8ioqH3f7iu6zFzLx+/5/v+una7vWvQGBZqp5T6AgC8LwndBdS5g4hO7ud3KAJwHGcDIv5lP2UV+fudRJToAinXdT9gjm4CgJ8zmCLi/cx809QLOvQFro7jfAoR3wUAvxDk6z+Z+SuD9Cp65dtcNuv7/kWIeGog8z8A8Aki+mySNaKUugMAEuldJOl3ErqZ+Y89z9vYT3coAqjVasfbtm3WBMgD8C9E1OsTOlZ8lFKvXLx48b4o4/2wDjiO83oj63neD8O2iSoXzAu8nIjMKVOJP0qp7wHAGxM3VAAD3W53WafTebSfq6EIwChxXfcGZr64n8Iq/H1qQu3Nnuf9cxViLUqMjuP8GiJ+tyj+JuknIm7SWodavxOaABzHOQERH0rS8aLoHvS78qLEV0Q/o3zVWcT4ovjMzCd6nvdwmDahCcAoU0rJOQH7UU1tGBAmiSIzXZvS/d9fCPPu++9VI5EIoF6vr7As68CRwhUvvNOI6N6KY5CL8JVSqwHgnlw4k7ETvu+vbLfbO8O6EYkAgl6AmYk+N6yBEst9iYh+v8TxFSY0pdTfAMB7C+Nwco7eRkTnRVEfmQBkvfV+eJl5wrbtt7ZarX+JArjIxotAo9F4Y7fb/TYiVv7wmkH2qUQmAJM+13X/npnPiTeVxdPGzJ/2PO+Piud5eTx2HOevEPHD5YlosEgQ8Xat9e9GbT0QAciY6wDMz1qW9bZWq/VvUYEX+eERaDQar/F9/1sAcMTw2gqvYaA5qYEIIJgLkFVX+2vmaiIKtYuv8CWWswCUUlcBgFkxWfVn4NWpAxNAvV6vW5blVR35qQLsmrMTPc+7W7BIDwHHcU43Z91NEbCdntV8Whp0B6eJZmACMI0dx2kiYiOfsKTq1XNTB1G8w/O8f0rVakWNOY7z61MTXl8DgMMrCsGBsIc9XGVYAjhtasvh9qonIYj/SSI6RrBIHgGl1G4AODp5S/m3MLVVf43neQOvgRiKAIK5ANmC+VKdxLKlNv9ll52HfbY0Z+dYNpaH3po+NAHUarXjbNs2qwOPzQaD3Fl9kIhOyp1XJXBIKWUOplleglDiCOGJbre7stPpPD6MsqEJwBgP9q8nutd7mCAzaPsDRFw9tSPriQxsl87k1E7UY5nZLLteVrrgBgwIET+otb5uwOYHmsVCAMFQIPTJs8M6XYT2iPg0AJyjtR4vgr959dGsPJ06lPZ2Zj4qrz5m4NdQR7fN9jc2AnBd12FmygCMPJucBIBrLMu6SRYLRUtTsMjH3Gb70anThEaitS63NCIqrXUsX8HHRgBBL+BLANDzEoJyp2XB6J5l5htt275R9g4sXAXB2n5znNhFssJvXqyuJ6LYNj7FSgBjY2Ovm5yc3ImI0l2bJ3dmAxEi3uj7/t2DHL1dZgINFpadzszm5a/8xp75cs3MT4+MjKxoNpvmcNdYnlgJIOgFXAYAfQ8jjMX7YisxSWwj4q1a61D3ARQ73EO9nzpB+LeY2WxfNacID30icdnwmSeeDUR0bZxxxk4AAQnIMeLRsmQOXDU3MD2JiLt933/S/G5Z1vPR1ORT2vf9V5iFO5ZlHc3MZrGUWcRjbqyRWf3wKQt1zHd4dfslkyIAc++brI2Pmg2RFwR6I3A6ETXjBigRAjBOyiGNcadK9FUVgSQPoU2MAIKhQN+rrqqaVIlbEAiJQGJXqSU2BJgJLLjqatsC11GFxEDEBIFKIrDL9/21SV2lljgBGANRbqatZIolaEGgBwJTF52cqbW+K0mAEh0CzDgu8wFJplB0lxGBJMf9s/FKhQBkPqCMJSoxJYhAouP+TAhA5gMSLBdRXSYEEh/3Z0IAMh9QphqVWJJCII1xf2YEYAzLfEBSpSN6i45AWuP+TAkgIIEtiHhW0RMm/gsCcSHAzHd4nnd2XPrC6kltEnC2Q2vWrDlsdHRUA4A57EEeQaDqCIxPTEy427dvfyFtIDIhABPk2rVrjxkZGTEnCr8p7aDFniCQIwS+Nzk5uWbbtm3mpOPUn8wIwETaaDSW+b5/PwDIcdqpp14M5gCB3ZZlndpqtcxu0EyeTAkgmA84ARHN9mE5BCKTEhCjGSEwwcwne573cEb2p81mTgABCcgFI1lWgdhOHYFhL/SIy+FcEIAJxnXds5l5c1yBiR5BIK8IIOJ6rfWWPPiXGwIwYCilzEGQf5sHYMQHQSAhBN5DRDcmpDuy2lwRQDAc+BAifjpyJNJAEMg5Asz8Yc/zPpMnN3NHAAEJXIGIl+cJKPFFEBgGAWa+wvO8K4fRkUTbXBJAMCdwoTlLP4mgRacgkCYC5o4DrfVNadoMayu3BBCQwDuDO+HCxiNygkCuEAjuiLwvV07NcibXBBAMB8w6gYfyCqD4JQj0QoCZT8z6e/5+2ck9AZgAarXam23bNgsmFvULSP4uCOQAgX3dbveETqfz3Rz4sqALhSAAE4G5dqzb7ZrLR1+fd1DFv0oj8EPbtlWc13cliWZhCCAggVd3u91bAeCUJEER3YLAgAh81bbt85rN5n8N2D71ZoUiAIOOUuqVU8eMf8X8mjpaYlAQ6I2A6Z2+i4h+UiSQCkcABtx6vf4yy7JMTyD1AxSKlFzxNTUEtvi+f1673f5pahZjMlRIApiJXY4Xi6kKRM3ACGRxjNfAzs7TsNAEYOIJLh4x15EvjRMY0SUI9EFgFyJuSPrijqSzUHgCCIYESy3LMiRwRtKAiX5BAADu8n1/Q5JXdqWFcikIQIYEaZWL2Cl6l//gDJaKAGRIIC9oggiUostfegKQIUGCr0B1VZemy18JApAhQXXf1LgjL1uXv1IEYIJVSo0BwAYAWBl3cYi+UiOwAwA2ElGzzFGWbg6gV7KUUpcx8wZEPKrMCZXYhkOAmZ9GRPPiXzucpmK0rgwBmHQEG4pMb+DSYqRHvEwZgett295YlI08cWBTKQKYAcx1Xcf0BuRqsjhKqBQ6xs2nvtbaK0U0EYKoJAHMIoIPBERwbATMRLQ8CDwRvPjXlSekaJFUmgAMVLVa7Tjbtk1v4H3RoBPpgiPwxW63u7HT6Txe8DiGcr/yBDCDnuM4pwHA+xGxMRSi0jjXCDBzCwA+73nePbl2NCXnhAAOArper9cty7oYAM5MKQdiJh0E7vR9f1OFXQhjAAACYklEQVS73W6nY64YVoQAeuRJKbUaES9m5nOKkUrxcj4EEPF2Zt5ERPcKQociIATQpypc113FzKZHcK4UUKEQuA0RN2mtxwvldcrOCgGEBLxer68IhgYXhGwiYtkgcHPQ1d+ZjfliWRUCiJgvx3FOMEQQ9AoithbxpBAwn/bmxc/7OfxJxT+oXiGAAZGr1WrHW5Y1hohmr4HsMxgQxyGb7WDmpu/7zU6n8+iQuirZXAgghrS7rrucmU83q40B4A0xqBQVvRH4PgA0EfFurfWDAtRwCAgBDIffIa0dx3GDXoEhg1fFrL6q6p4yL735tPc8T1cVhCTiFgJIAlUAWLdu3RGTk5OGBMaY2fx3NCFTZVU7gYhmK25zZGSkuXXr1mfLGmiWcQkBpIC+Uuq1ALAaAE4O5guOS8FsEU2YZblmH/43pnC6l4geK2IQRfJZCCCDbJk5A9/334GIhhDMz89m4EYeTP6vedmZ+RuWZX1NxvTpp0QIIH3MD7aISql3MvOpiHgqAJyQvUuJevAwM9+PiPcT0X0AwIlaE+ULIiAEkLMCWbNmzWGjo6PvBICTzGUniLiUmc2lJ4fnzNV+7jyHiLuYedfUnXnm54GJiYn7tm/f/kK/hvL39BAQAkgP66Es1ev1I0dGRqbJYObHkENwI9LRQykfvPGT5uU2L7l52Wd+Jicnd7Xb7WcGVyst00JACCAtpBO0Y3oNixYtWtrtdo9h5iWWZS1hZtNjWIKIB/++xPQmgn83vwMi7mHmPQBgPrVnft+DiM8F/z79u+/75r97bNvevW/fvl3yaZ5gUlNS/f/TQ6AIGfcYwgAAAABJRU5ErkJggg=="></span>
                                </button>
                                <!--削除用のボタン-->
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            document.getElementById("backmenubuttoncontainer").addEventListener("click", function(){
                document.getElementById("backmenulink").click();
                return;
            });
            
            const loading = document.getElementById('loading');
            
            window.onload = function(){
                loading.classList.add('loaded');
            }
        </script>
    </body>
</html>
