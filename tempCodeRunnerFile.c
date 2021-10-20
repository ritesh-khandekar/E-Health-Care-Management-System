#include <stdio.h>
#include <stdlib.h>
#define max 10

int arr[10] , front = -1 , end = -1;

void enqueue(int x);
void dequeue();
void peek();
int isEMpty();
int overFlow();
void display();
void peek();

int main() {
    int n, option, ele;
    do {
        printf("Enter your choice:\n1. Enque\n2. Deque\n3. Peek\n");
        scanf("%d", &option);

        switch(option) {
            case 1 :
                printf("Enter value to be inserted: ");
                scanf("%d", &ele );

                enqueue(ele);
                printf("Queue after inserting elements: ");
                display();
                break;

            case 2 :
                //printf("Enter value to be Deleted :");
                //scanf("%d" ,&ele );

                dequeue();
                printf("\nQueue after Deletion: ");
                display();
                break;
            
            case 3:
                printf("Queue after Peek: ");
                peek();
                break;
        }

        printf("\nEnter 0 to exit and anything to continue: ");
        scanf("%d", &n);
    }while(n != 0);
    return 0;
}

void enqueue(int no) {
    if(front == -1 && end == -1) {
        front = 0;
        end = 0;
        arr[end] = no;
    }
    else if(overFlow()) {
        printf("Queue Overflow");
        exit(1);
    }
    else {
        end++;
        arr[end] = no;
    }
}

int overFlow() {
    if(end >= max - 1) 
        return 1;
    else
        return 0;
}

void display() {
    for(int i = front; i <= end; i++) {
        printf("\n%d", arr[i]);
    }
}

void dequeue() {
    if(isEMpty()) {
        printf("The Queue is Empty");
        //exit(1);
    }
    else {
        printf("Element deleted is %d ", arr[front]);
        front++;
    }
}

int isEMpty() {
    if(front == -1 && end == -1)
        return 1;
    else
        return 0;
}

void peek() {
    printf( "%d", arr[front]);
}