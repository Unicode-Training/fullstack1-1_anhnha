import fs from "fs/promises";
import path from "path";
export const helloWorld = async (value: string) => {
    // console.log(path.resolve('./data/data.json'));

    const data = await fs.readFile(path.resolve('./data/data.json'), 'utf-8');
    console.log(data);
    return 'helloWorld: ' + value;
}