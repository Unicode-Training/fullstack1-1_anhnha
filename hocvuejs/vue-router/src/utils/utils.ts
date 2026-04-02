//rest parameters
export const debounce = <A>(fn: (...args: A[]) => void, timeout = 500) => {
  let timeoutId: number;
  return (...args: A[]) => {
    if (timeoutId) {
      clearTimeout(timeoutId);
    }
    timeoutId = setTimeout(() => {
      fn(...args); //spread
    }, timeout);
  };
};

//Generics

//Debounce -> Nhận vào 1 hàm --> trả về 1 hàm mới

//event listener => Nhận 1 hàm

//Closure

//const handleSearch = debounce(() => {
//logic
//}, 500)
//handleSearch()
//handleSearch()
//handleSearch()
//handleSearch()

/*

const demoClosure = () => {
    let a = 10;
    return () => {
        console.log('Hàm closure')
        a++;
    }
}

const demoFunc = demoClosure();
demoFunc();
demoFunc();
demoFunc();
demoFunc();

*/

// const demoClosure = () => {
//   let a = 10;
//   return () => {
//     console.log("Hàm closure");
//     a++;
//     console.log(a);
//   };
// };

// const demoFunc = demoClosure();
// demoFunc();
// demoFunc();
// demoFunc();
// demoFunc();

//rest parameter
// const sum = (...args) => {
//   console.log(args);
// };
// sum(5, 10, 15, 12);

// const sum = (a: number, b: number) => {
//   console.log(a, b);
// };
// const values = [10, 20];
// sum(...values); //spread (Dải ra)
