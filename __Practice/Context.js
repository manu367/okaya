const readline = require("readline");
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

class Graph{
    constructor() {
        this.adjacency=new Map();
    }
    addNode(data){
        if(this.adjacency.has(data))return;
        this.adjacency.set(data,new Node(data));
    }
    addEdge(data1,data2){

    }
    shortestPath(){}
    printgrpah(){}

}

class Node {
    constructor(data) {
        this.data = data;
        this.behaviour = null;
    }
}

class Linkedlist {
    constructor() {
        this.head = null;
    }

    addNode(data) {
        const node = new Node(data);

        if (this.head === null) {
            this.head = node;
            return; // 👈 THIS is the missing shield
        }

        let temp = this.head;
        while (temp.behaviour !== null) {
            temp = temp.behaviour;
        }
        temp.behaviour = node;
    }

    deleteNode(data) {
        // agar list empty hai
        if (this.head === null) return false;

        // agar head hi target hai
        if (this.head.data === data) {
            this.head = this.head.behaviour;
            return true;
        }

        let prev = this.head;
        let curr = this.head.behaviour;

        while (curr !== null) {
            if (curr.data === data) {
                prev.behaviour = curr.behaviour; // chain reconnect
                return true;
            }
            prev = curr;
            curr = curr.behaviour;
        }

        return false; // nahi mila
    }

    find(v) {
        let result = { isExist: false, position: -1, value: null };

        if (this.head === null) return result;

        let temp = this.head;
        let i = 0;

        while (temp !== null) {
            if (temp.data === v) {
                return {
                    isExist: true,
                    position: i,
                    value: temp.data
                };
            }
            temp = temp.behaviour;
            i++;
        }

        return result;
    }

    print() {
        let temp = this.head;
        while (temp !== null) {
            console.log(temp.data);
            temp = temp.behaviour;
        }
    }
}

let count = 0;
const linkedlist = new Linkedlist();


