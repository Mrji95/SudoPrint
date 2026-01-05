cmake_minimum_required(VERSION 3.20)
project(SudoPrint VERSION 1.0.0 LANGUAGES CXX)

set(CMAKE_CXX_STANDARD 20)
set(CMAKE_CXX_STANDARD_REQUIRED ON)

add_library(sudoprint INTERFACE)
target_include_directories(sudoprint INTERFACE include)


if(CMAKE_PROJECT_NAME STREQUAL PROJECT_NAME)
    option(SUDO_BUILD_EXAMPLES "Build example programs" ON)
else()
    option(SUDO_BUILD_EXAMPLES "Build example programs" OFF)
endif()

if(SUDO_BUILD_EXAMPLES)
    message(STATUS "SudoPrint: Building examples...")
    add_executable(sudo_demo examples/demo.cpp)
    target_link_libraries(sudo_demo PRIVATE sudoprint)
endif()