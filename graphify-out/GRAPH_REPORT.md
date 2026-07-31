# Graph Report - Tugas_Bootcamp  (2026-07-27)

## Corpus Check
- 26 files · ~744,814 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 31 nodes · 9 edges · 23 communities
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `98eee147`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Tugas 9 - TokoKu (E-Commerce)
- Fitur

## God Nodes (most connected - your core abstractions)
1. `Tugas 9 - TokoKu (E-Commerce)` - 7 edges
2. `Fitur` - 3 edges
3. `Halaman` - 1 edges
4. `Akses Admin` - 1 edges
5. `Database` - 1 edges
6. `Customer` - 1 edges
7. `Admin (Seller)` - 1 edges
8. `Cara Menjalankan` - 1 edges
9. `Teknologi` - 1 edges

## Surprising Connections (you probably didn't know these)
- None detected - all connections are within the same source files.

## Import Cycles
- None detected.

## Communities (23 total, 0 thin omitted)

### Community 7 - "Tugas 9 - TokoKu (E-Commerce)"
Cohesion: 0.29
Nodes (6): Akses Admin, Cara Menjalankan, Database, Halaman, Teknologi, Tugas 9 - TokoKu (E-Commerce)

### Community 8 - "Fitur"
Cohesion: 0.67
Nodes (3): Admin (Seller), Customer, Fitur

## Knowledge Gaps
- **7 isolated node(s):** `Halaman`, `Akses Admin`, `Database`, `Customer`, `Admin (Seller)` (+2 more)
  These have ≤1 connection - possible missing edges or undocumented components.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Tugas 9 - TokoKu (E-Commerce)` connect `Tugas 9 - TokoKu (E-Commerce)` to `Fitur`?**
  _High betweenness centrality (0.076) - this node is a cross-community bridge._
- **Why does `Fitur` connect `Fitur` to `Tugas 9 - TokoKu (E-Commerce)`?**
  _High betweenness centrality (0.034) - this node is a cross-community bridge._
- **What connects `Halaman`, `Akses Admin`, `Database` to the rest of the system?**
  _7 weakly-connected nodes found - possible documentation gaps or missing edges._