<template>
  <div class="p-3">
    <h2 class="text-2xl mb-3">Danh sách người dùng</h2>
    <User
      v-for="user in users"
      v-bind="user"
      @submit="handleSave"
      @delete="handleDelete"
    />
  </div>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import User from "./User.vue";
type FormData = {
  name: string;
  email: string;
  id: number;
};
const users = ref([
  {
    id: 1,
    name: "User 1",
    email: "user1@gmail.com",
  },
  {
    id: 2,
    name: "User 2",
    email: "user2@gmail.com",
  },
  {
    id: 3,
    name: "User 3",
    email: "user3@gmail.com",
  },
]);
const handleSave = ({ id, ...data }: FormData) => {
  users.value = users.value.map((user) => {
    if (user.id === id) {
      return {
        id,
        ...data,
      };
    }
    return user;
  });
};

const handleDelete = (id: number) => {
  users.value = users.value.filter((user) => user.id !== id);
};

//spread: dải các key ở trong object ra ngoài
// const myObj = {
//   name: "An",
//   email: "an@gmail.com",
// };
// const newObj = {
//   age: 35,
//   ...myObj,
// };
// console.log(newObj);

//rest parameter
// const dosomething = (a, b, ...args) => {
//   console.log(a, b);
//   console.log(args);
// };
// dosomething(1, 2, 3, 4, 5, 6);

// const showNumber = (n) => {
//   console.log(n);
//   if (n > 1) {
//     showNumber(n - 1);
//   }
// };
// showNumber(10);

//Đệ quy
// - Cơ sở
// = Lời gọi đệ quy --> Đảm bảo giá trị tiến đến phần cơ sở để khử đệ quy

// const sum = (n) => {
//   //Phần cơ sở
//   if (n === 1) {
//     return 1;
//   }
//   const result = n + sum(n - 1);
//   console.log(n, result);
//   return result;
// };
// console.log(sum(3));

//10 + sum(9)
//9 + sum(8)
//8 + sum(7)
//7 + sum(6)
//6 + sum(5)
//5 + sum(4)
//4 + sum(3)
//3 + sum(2)
//2 + sum(1)
//1

// const myUsers = [
//   {
//     id: 1,
//     name: "User 1",
//     parent: 0,
//   },
//   {
//     id: 2,
//     name: "User 2",
//     parent: 1,
//   },
//   {
//     id: 3,
//     name: "User 3",
//     parent: 1,
//   },
//   {
//     id: 4,
//     name: "User 4",
//     parent: 1,
//   },
//   {
//     id: 5,
//     name: "User 5",
//     parent: 0,
//   },
//   {
//     id: 6,
//     name: "User 6",
//     parent: 2,
//   },
//   {
//     id: 7,
//     name: "User 7",
//     parent: 6,
//   },
//   {
//     id: 8,
//     name: "User 8",
//     parent: 3,
//   },
// ];
// const idDelete = 2;
// //output: [1,2,3,4,6]
// const getIds = (myUsers, parent) => {
//   let ids = [parent];
//   for (let user of myUsers) {
//     if (user.parent === parent) {
//       if (!ids.includes(user.id)) {
//         ids.push(user.id);
//       }
//       const result = getIds(myUsers, user.id);
//       for (let item of result) {
//         if (!ids.includes(item)) {
//           ids.push(item);
//         }
//       }
//     }
//   }
//   return ids;
// };
// console.log(getIds(myUsers, idDelete));
</script>
