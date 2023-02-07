# container-surface

## Quick start
```
docker build -t container-surface .
docker run -it --rm -v "$PWD":/srv/app -u $UID:$GID container-surface composer install
docker run -it --rm -v "$PWD":/srv/app -u $UID:$GID container-surface bin/console app:transport
```

## The Assignment
### Introduction
We want to calculate how many containers of each type we need for
a transport. We want to use as less containers as possible, so we
don't send a lot of half empty containers.

### Assignment
Objects  
We transport objects in a container at the moment we have 2 object
types:
- rectangle  
 properties: width, length
- circle  
 properties: radius

Containers  
At the moment we have two types of containers:
- big container  
 width 300, length 200
- small container  
 width 100, length 100

### Question
How many containers do we need and from what type for the
following transports
#### Transport 1
circle: radius 50  
circle: radius 50  
rectangle: width 100, length 100
#### Transport 2
rectangle: width 400, length 400  
circle: radius 100
#### Transport 3
rectangle; width 150, length 100  
rectangle; width 50, length 50  
circle; radius 50
