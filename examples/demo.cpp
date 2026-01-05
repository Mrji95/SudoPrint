#include <sudoprint.hpp>
#include <vector>
#include <string>

// --- Scenario 1: The "Perfect" Way (With Macro) ---
struct Product {
    std::string name;
    double price;
    std::vector<std::string> tags;
};

// Register for JSON Key-Value output
SUDO_ADAPT(Product, name, price, tags)

// --- Scenario 2: The "Lazy" Way (No Macro) ---
// On macOS: Will trigger Clang's __builtin_dump_struct (Purple Output)
// On others: Will trigger Fallback (Values only)
struct Point {
    int x;
    int y;
};

int main() {
    // 1. Test Macro Mode
    std::cout << ">>> 1. Macro Mode (JSON Key-Value) <<<\n";
    Product p = {"MacBook Pro", 1999.99, {"Apple", "Laptop", "M3"}};
    sudo::print(p);

    // 2. Test Auto/Mac Mode
    std::cout << "\n>>> 2. Auto Mode (Mac Magic / Fallback) <<<\n";
    Point pt = {10, 20};
    sudo::print(pt);

    return 0;
}