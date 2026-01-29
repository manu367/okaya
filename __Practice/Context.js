class AlgorithmScheduler{
    constructor(data) {
        this.data=data;
    }
    twopointerAlgorithm(arr,target){
        arr = arr.sort((a, b) => a - b);
        let left=0;
        let right=arr.length-1;
        while(left<arr.length){
            let result=arr[left]+arr[right];
            if(result===target){
                return [arr[left],arr[right],result];
            }
            else if(result<target){
                left++;
            }else{
                right--;
            }
        }
        return [-1,-1,target];
    }
    slidingWindow(arr, target) {
        let left = 0;
        let sum = 0;

        for (let right = 0; right < arr.length; right++) {
            sum += arr[right];

            while (sum > target && left <= right) {
                sum -= arr[left];
                left++;
            }

            if (sum === target) {
                return arr.slice(left, right + 1);
            }
        }
        return [-1];
    }
    add(num=0){
        if (num===841){return num;}
        this.add(num+1);
        setTimeout(()=>{console.log(num);},num*100);
    }
}
let arr=[1,2,423,34,5,3,6,7,8,8,]
let a=new AlgorithmScheduler(12);
a.add(1);