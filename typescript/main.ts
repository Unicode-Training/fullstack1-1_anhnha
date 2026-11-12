// type BaseUser = {
//     id: number;
//     name: string;
// }
// type User = BaseUser & {
//     email: string;
//     age: number;
//     id: string;
// }
// interface BaseUser {
//     id: number;
//     name: string;
// }
// interface User extends BaseUser {
//     email: string;
//     age: number;
//     id: string;
// }
// interface BaseUser {
//     email: string;
//     age: number;
// }
// const user: User = {
//     id: 10,
//     name: 'An',
//     email: 'user1@gmail.com',
//     age: 30
// }

interface User {
    id: number;
    name: string;
    email: string;
    password: string;
}

const user: User = {
    id: 10,
    name: 'An',
    email: 'user1@gmail.com',
    password: '1234'
}

const customer: Omit<User, 'password' | 'email'> = {
    id: 10,
    name: 'An',
    // email: 'user1@gmail.com',
}