# Vuejs Basic

## Template

- Hiển thị giá trị lên giao diện: {{tenbien,giatri,goiham}}
- Đẩy giá trị vào thuộc tính: v-bind:tenthuoctinh="tenbien,giatri,goiham"

- Ẩn hiện: v-if, v-show

truthy

- Các giá trị được đặt trong ngữ cảnh logic (boolean) được ngầm hiểu là true -> truthy

falsey

- Các giá trị được đặt trong ngữ cảnh logic (boolean) được ngầm hiểu là false -> falsy

Các giá trị: 0, "", undefined, null, false, NaN

- Render 1 danh sách: v-for

- Event

* submit: Áp dụng với thẻ form
* click: Khi user click vào thẻ html
* mousedown: Khi user bấm chuột xuống
* mouseup: Khi user nhả chuột
* mousemove: Khi user di chuyển chuột trong khu vực của thẻ html
* keyup: Khi user nhả phím
* keydown: Khi user nhấn phím

Cách áp dụng trong vue

- @tenevent
- v-on:tenevent
