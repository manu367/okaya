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
class GraphNode {
    constructor(value) {
        this.value = value;
        this.adjacent = new Set();
    }
    addNode(node) {
        this.adjacent.add(node);
    }
    removeNode(node) {
        this.adjacent.delete(node);
    }
}
// undirect node
class Graph {
    constructor() {
        this.nodes = new Map();
    }
    addNode(value) {
        if (!this.nodes.has(value)) {
            this.nodes.set(value, new GraphNode(value));
        }
        return this.nodes.get(value);
    }
    addEdge(v1, v2) {
        const node1 = this.addNode(v1);
        const node2 = this.addNode(v2);
        node1.addNode(node2);
        node2.addNode(node1);
    }
    removeEdge(v1, v2) {
        this.nodes.get(v1)?.removeNode(this.nodes.get(v2));
        this.nodes.get(v2)?.removeNode(this.nodes.get(v1));
    }
}
const graph = new Graph();
graph.addEdge('A', 'B');
graph.addEdge('A', 'C');
graph.addEdge('B', 'C');

class LinkedListNode {
    constructor(value) {
        this.value = value;
        this.next = null;
    }
}
class LinkedList {
    constructor() {
        this.head = null;
    }
    addNode(data) {
        const node = new LinkedListNode(data);
        if (this.head === null) {
            this.head = node;
            return;
        }
        let temp = this.head;
        while (temp.next !== null) {
            temp = temp.next;
        }
        temp.next = node;
    }
    deleteLastNode() {
        if (!this.head) return;
        if (this.head.next === null) {
            this.head = null;
            return;
        }
        let temp = this.head;
        while (temp.next.next !== null) {
            temp = temp.next;
        }
        temp.next = null;
    }
    searchNode(data) {
        let temp = this.head;
        while (temp !== null) {
            if (temp.value === data) {
                console.log("Value exists:", temp.value);
                return true;
            }
            temp = temp.next;
        }
        console.log("Value not found:", data);
        return false;
    }
    print() {
        let temp = this.head;
        let str = "";
        while (temp !== null) {
            str += temp.value;
            if (temp.next !== null) str += " -> ";
            temp = temp.next;
        }
        console.log(str);
    }
}
const algo=new AlgorithmScheduler();
console.log(algo.twopointerAlgorithm([12,20,5,90,88,76,40],25));
// const linkedlist = new LinkedList();
// linkedlist.addNode(12);
// linkedlist.addNode(13);
// linkedlist.addNode(14);
// linkedlist.addNode(15);
// linkedlist.print();
// linkedlist.deleteLastNode();
// linkedlist.print();
// linkedlist.searchNode(13);