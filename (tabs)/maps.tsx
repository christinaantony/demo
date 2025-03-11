import React, { useState } from "react";
import { VStack } from "@/components/ui/vstack";
import { Input, InputField, InputSlot, InputIcon } from "@/components/ui/input";
import { ListFilter } from "lucide-react-native";
import { Icon, SearchIcon } from "@/components/ui/icon";
import { Pressable } from "@/components/ui/pressable";
import { HStack } from "@/components/ui/hstack";
import { useSafeAreaInsets } from "react-native-safe-area-context";
import Map from "@/components/screens/maps/current-location-map";

const Maps = () => {
  const [value, setValue] = useState("");
  const insets = useSafeAreaInsets();

  return (
    <VStack className="flex-1 bg-background-0 relative">
      <HStack
        className="px-5 py-4 absolute z-10"
        space="sm"
        style={{ top: insets.top }}
      >
        <Input
          size={"xl"}
          className="flex-1 bg-background-50/75 rounded-lg border-outline-100 data-[focus=true]:border-outline-400"
        >
          <InputField
            value={value}
            onChangeText={setValue}
            placeholder="Search a trail"
          />
          <InputSlot className="pr-4">
            <InputIcon
              as={SearchIcon}
              className="text-background-400"
              size="md"
            />
          </InputSlot>
        </Input>

        <Pressable className="bg-background-50/75 p-3 rounded-lg border border-outline-100 items-center justify-center">
          <Icon as={ListFilter} size="lg" className="text-background-500" />
        </Pressable>
      </HStack>

      <Map />
    </VStack>
  );
};

export default Maps;
