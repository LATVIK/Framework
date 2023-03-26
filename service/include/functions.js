function deletePost(postId)
{
    fetch('http://127.0.0.1/api/delete-post', {
        method: 'DELETE',
        headers: {
            post_id: postId,
            token: document.cookie
        }
    }).then(r => {
        if (r.status === 200) {
            document.getElementById('post-' + postId).remove();
            if (document.getElementsByClassName('post').length === 0) {
                let div = document.createElement("h2")
                div.appendChild(document.createTextNode("Posts not found"));
                let content = document.getElementsByClassName('content')[0];
                content.appendChild(div);
            }
        } else {
            alert(r.statusText + " " + r.status)
        }
    });
}