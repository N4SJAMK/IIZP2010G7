# Vagrant:in käyttöohjeet

This repository contains example projects to help you get started on
development!

## Getting Started

The examples use `vagrant`. It is an automation tool for creating identical
development environments from simple configuration. Use it.

1. Browse into the `examples` directory of your choice.
2. Run `vagrant up` followed by `vagrant ssh`.

Now you have a working development environment open in your terminal. You can
use this to build, run and test your code. Refer to each individual example on
how to run them.

## Workflow

By using `vagrant` as described above, you are able to have identical
environments across your team members. This means that the "works on my
machine" - argument is invalid, since all machines are identical.

Essentially the workflow will boil down to the following:

1. Edit code on your `host` machine.

   The files are automagically synced to the `guest` machine, which we created
   by running `vagrant up`. Refer to each example's `vagrantfile` on where the
   files are actually synced to.

2. Build, run and test the code on your `guest` machine.

   By running `vagrant ssh`, you open a session to your `guest` machine.

3. Remember to commit and merge your changes often.
