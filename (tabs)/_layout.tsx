import React from "react";
import { Tabs } from "expo-router";
import { CustomTabBar } from "@/components/shared/custom-tab-bar";

export default function TabLayout() {
  return (
    <Tabs
      screenOptions={{
        headerShown: false,
      }}
      tabBar={(props: any) => <CustomTabBar {...props} />}
    />
  );
}
