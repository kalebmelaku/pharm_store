const ul = document.getElementById('items');
// const posts = [
//     { title: 'Post One', body: 'This is post one' },
//     { title: 'Post Two', body: 'This is post two' }
// ];

// function getPosts()
// {
//     setTimeout(() =>
//     {
//         let output = '';
//         posts.forEach((post) =>
//         {
//             output += `<li>${post.title}</li>`;
//         });
//         ul.innerHTML = output;
//     }, 2000);
// }
// function createPost(post)
// {
//     return new Promise((res, rej) =>
//     {
//         setTimeout(() =>
//         {
//             posts.push(post);
//             const error = true;

//             if (!error) {
//                 res();
//             } else {
//                 rej('Error: Something went wrong');
//             }
//         }, 3000);
//     });
// }
// createPost({ title: 'Post Three', body: 'This is post three' })
//     .then(getPosts)
//     .catch(err => console.log(err));
// createPost({title: 'Post Three', body: 'This is post three'}, getPosts)
// function test()
// {

//     fetch('https://jsonplaceholder.typicode.com/posts/')
//         .then(response => response.json())
//         .then(data =>
//         {
//             data.forEach(element =>
//             {
//                 const li = document.createElement('li');
//                 li.className = 'list-group-item';
//                 li.appendChild(document.createTextNode(element.title));
//                 ul.appendChild(li);
//             });
//         })
//         .catch(err => console.error(err));

// }
function test()
{
    const response = axios.get('https://jsonplaceholder.typicode.com/posts/');
    let data = response.data;

    data.forEach((post) =>
    {
        console.log(post);
        const li = document.createElement('li');
        li.className = 'list-group-item';
        li.appendChild(document.createTextNode(post.title));
        ul.appendChild(li);
    });

}

test();