import React, { useState } from "react";
import { Link } from "expo-router";
import { HStack } from "@/components/ui/hstack";
import { Pressable } from "@/components/ui/pressable";
import { Text } from "@/components/ui/text";

const Tabs = () => {
  const [selectedTab, setSelectedTab] = useState("hourly");

  const handlePress = (name: string) => {
    setSelectedTab(name);
  };
  return (
    <HStack space="xs" className="px-5 py-2 bg-background-0">
      <Link href="/" asChild>
        {/* Use asChild when wrapping touchable components */}
        <Pressable
          onPress={() => handlePress("hourly")}
          className={`${
            selectedTab === "hourly" ? "bg-primary-500" : "bg-background-50"
          } flex-1 rounded-full items-center justify-center h-[37px]`}
        >
          <Text
            className={`${
              selectedTab === "hourly" ? "text-black" : "text-typography-950"
            }`}
          >
            Hourly
          </Text>
        </Pressable>
      </Link>

      <Link href="/days" asChild>
        <Pressable
          onPress={() => handlePress("days")}
          className={`${
            selectedTab === "days" ? "bg-secondary-400" : "bg-background-50"
          } flex-1 rounded-full items-center justify-center h-[37px]`}
        >
          <Text
            className={`${
              selectedTab === "days" ? "text-black" : "text-typography-950"
            }`}
          >
            10 days
          </Text>
        </Pressable>
      </Link>

      <Link href="/monthly" asChild>
        <Pressable
          onPress={() => handlePress("monthly")}
          className={`${
            selectedTab === "monthly" ? "bg-secondary-400" : "bg-background-50"
          } flex-1 rounded-full items-center justify-center h-[37px]`}
        >
          <Text
            className={`${
              selectedTab === "monthly" ? "text-black" : "text-typography-950"
            }`}
          >
            Monthly
          </Text>
        </Pressable>
      </Link>
    </HStack>
  );
};

export default Tabs;
