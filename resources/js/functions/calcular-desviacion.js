
function calcularDes(arr){
    console.log({arr})

    // Creating the mean with Array.reduce
    let mean = arr.reduce((acc, curr)=>{
        return acc + curr
    }, 0) / arr.length;

    // Assigning (value - mean) ^ 2 to every array item
    arr = arr.map((k)=>{
        return (k - mean) ** 2
    })

    // Calculating the sum of updated array
    let sum = arr.reduce((acc, curr)=> acc + curr, 0);

    // Calculating the variance
    let variance = sum / arr.length

    // Returning the Standered deviation
    return Math.sqrt(sum / arr.length)
}


// console.log(calcularDes([1.5, 1.59, 1.49]))
// console.log(calcularDes([750, 750, 749.3]))

export default calcularDes;
